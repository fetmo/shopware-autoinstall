<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Components\Api\Resource;

use Shopware\Components\Api\Exception as ApiException;
use Shopware\Components\Random;
use Shopware\Components\Thumbnail\Manager;
use Shopware\Models\Media\Album;
use Shopware\Models\Media\Media as MediaModel;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Media API Resource
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Media extends Resource
{
    const FILENAME_LENGTH = 200;

    /**
     * @return \Shopware\Models\Media\Repository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository(MediaModel::class);
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return array|MediaModel
     */
    public function getOne($id)
    {
        $this->checkPrivilege('read');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException('id');
        }

        $filters = [['property' => 'media.id', 'expression' => '=', 'value' => $id]];
        $query = $this->getRepository()->getMediaListQuery($filters, [], 1);

        /** @var $media MediaModel */
        $media = $query->getOneOrNullResult($this->getResultMode());

        if (!$media) {
            throw new ApiException\NotFoundException("Media by id $id not found");
        }

        $mediaService = Shopware()->Container()->get('shopware_media.media_service');
        $media['path'] = $mediaService->getUrl($media['path']);

        return $media;
    }

    /**
     * @param int   $offset
     * @param int   $limit
     * @param array $criteria
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($offset = 0, $limit = 25, array $criteria = [], array $orderBy = [])
    {
        $this->checkPrivilege('read');

        $query = $this->getRepository()->getMediaListQuery($criteria, $orderBy, $limit, $offset);
        $query->setHydrationMode($this->resultMode);

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the category data
        $media = $paginator->getIterator()->getArrayCopy();

        $mediaService = Shopware()->Container()->get('shopware_media.media_service');
        array_walk($media, function (&$item) use ($mediaService) {
            $item['path'] = $mediaService->getUrl($item['path']);
        });

        return ['data' => $media, 'total' => $totalResult];
    }

    /**
     * @param array $params
     *
     * @throws \Shopware\Components\Api\Exception\ValidationException
     * @throws \Exception
     *
     * @return MediaModel
     */
    public function create(array $params)
    {
        $this->checkPrivilege('create');

        $params = $this->prepareMediaData($params);

        $media = new MediaModel();
        $media->fromArray($params);

        $path = $this->prepareFilePath($media->getPath(), $media->getFileName());
        $media->setPath($path);

        $violations = $this->getManager()->validate($media);
        if ($violations->count() > 0) {
            throw new ApiException\ValidationException($violations);
        }

        $this->getManager()->persist($media);
        $this->flush();

        if ($media->getType() == MediaModel::TYPE_IMAGE) {
            /** @var $manager Manager */
            $manager = $this->getContainer()->get('thumbnail_manager');

            $manager->createMediaThumbnail($media, [], true);
        }

        return $media;
    }

    /**
     * @param int   $id
     * @param array $params
     *
     * @throws \Shopware\Components\Api\Exception\ValidationException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\CustomValidationException
     *
     * @return MediaModel
     */
    public function update($id, array $params)
    {
        $this->checkPrivilege('update');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException('id');
        }

        /** @var $media MediaModel */
        $media = $this->getRepository()->find($id);

        if (!$media) {
            throw new ApiException\NotFoundException(sprintf('Media by id "%d" not found', $id));
        }

        if (!empty($params['file'])) {
            $tmpFile = $this->saveAsTempMediaFile($params['file']);
            $file = new UploadedFile($tmpFile, $params['file']);

            try {
                $this->getContainer()->get('shopware_media.replace_service')->replace($id, $file);
                @unlink($tmpFile);
            } catch (\Exception $exception) {
                @unlink($tmpFile);
                throw new ApiException\CustomValidationException($exception->getMessage());
            }
        }

        return $media;
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return MediaModel
     */
    public function delete($id)
    {
        $this->checkPrivilege('delete');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException('id');
        }

        /** @var $media MediaModel */
        $media = $this->getRepository()->find($id);

        if (!$media) {
            throw new ApiException\NotFoundException("Media by id $id not found");
        }

        $this->getManager()->remove($media);
        $this->flush();

        return $media;
    }

    /**
     * Internal helper function which is used to upload the passed image link
     * to the server and create a media object for the image.
     *
     * @param $link
     * @param $albumId
     *
     * @throws \Shopware\Components\Api\Exception\CustomValidationException
     *
     * @return MediaModel
     */
    public function internalCreateMediaByFileLink($link, $albumId = -1)
    {
        $name = pathinfo($link, PATHINFO_FILENAME);
        $ext = pathinfo($link, PATHINFO_EXTENSION);
        $name = $name . '.' . $ext;
        $path = $this->load($link, $name);
        $name = pathinfo($path, PATHINFO_FILENAME);
        $file = new UploadedFile($path, $link);

        $media = new MediaModel();

        $media->setAlbumId($albumId);
        $media->setFile($file);
        $media->setName($name);
        $media->setDescription('');
        $media->setCreated(new \DateTime());
        $media->setUserId(0);

        /** @var $album Album */
        $album = $this->getManager()->find(Album::class, $albumId);
        if (!$album) {
            throw new ApiException\CustomValidationException(
                sprintf('Album by id %s not found', $albumId)
            );
        }

        $media->setAlbum($album);

        try {
            //persist the model into the model manager this uploads and resizes the image
            $this->getManager()->persist($media);
        } catch (\Doctrine\ORM\ORMException $e) {
            throw new ApiException\CustomValidationException(
                sprintf('Some error occurred while loading your image')
            );
        }

        if ($media->getType() === MediaModel::TYPE_IMAGE) {
            /** @var $manager Manager */
            $manager = Shopware()->Container()->get('thumbnail_manager');

            $manager->createMediaThumbnail($media, [], true);
        }

        return $media;
    }

    /**
     * @param string $url          URL of the resource that should be loaded (ftp, http, file)
     * @param string $baseFilename Optional: Instead of creating a hash, create a filename based on the given one
     *
     * @throws \InvalidArgumentException
     * @throws \Exception
     *
     * @return bool|string returns the absolute path of the downloaded file
     */
    public function load($url, $baseFilename = null)
    {
        $destPath = Shopware()->DocPath('media_' . 'temp');
        if (!is_dir($destPath)) {
            mkdir($destPath, 0777, true);
        }

        $destPath = realpath($destPath);

        if (!file_exists($destPath)) {
            throw new \InvalidArgumentException(
                sprintf("Destination directory '%s' does not exist.", $destPath)
            );
        } elseif (!is_writable($destPath)) {
            throw new \InvalidArgumentException(
                sprintf("Destination directory '%s' does not have write permissions.", $destPath)
            );
        }

        if (strpos($url, 'data:image') !== false) {
            return $this->uploadBase64File(
                $url,
                $destPath,
                $baseFilename
            );
        }

        $urlArray = parse_url($url);
        $urlArray['path'] = explode('/', $urlArray['path']);
        switch ($urlArray['scheme']) {
            case 'ftp':
            case 'ftps':
            case 'http':
            case 'https':
            case 'file':
                $filename = $this->getUniqueFileName($destPath, $baseFilename);

                if (!$put_handle = fopen("$destPath/$filename", 'w+')) {
                    throw new \Exception("Could not open $destPath/$filename for writing");
                }

                if (!$get_handle = fopen($url, 'r')) {
                    throw new \Exception("Could not open $url for reading");
                }
                while (!feof($get_handle)) {
                    fwrite($put_handle, fgets($get_handle, 4096));
                }
                fclose($get_handle);
                fclose($put_handle);

                return "$destPath/$filename";
        }
        throw new \InvalidArgumentException(
            sprintf("Unsupported schema '%s'.", $urlArray['scheme'])
        );
    }

    /**
     * Helper function to get a unique file name for the passed destination path.
     *
     * @param $destPath
     * @param null $baseFileName
     *
     * @return null|string
     */
    public function getUniqueFileName($destPath, $baseFileName = null)
    {
        $mediaService = Shopware()->Container()->get('shopware_media.media_service');
        if ($baseFileName !== null && !$mediaService->has("$destPath/$baseFileName")) {
            return substr($baseFileName, 0, self::FILENAME_LENGTH);
        }

        $counter = 1;
        if ($baseFileName === null) {
            $filename = Random::getAlphanumericString(32);
        } else {
            $filename = $baseFileName;
        }

        $filename = substr($filename, 0, self::FILENAME_LENGTH);

        while ($mediaService->has("$destPath/$filename")) {
            if ($baseFileName) {
                $filename = "$counter-$baseFileName";
                ++$counter;
            } else {
                $filename = Random::getAlphanumericString(32);
            }
            $filename = substr($filename, 0, self::FILENAME_LENGTH);
        }

        return $filename;
    }

    /**
     * Helper function which downloads the passed image url
     * and save the image with a unique file name in the destination path.
     * If the passed baseFilename already exists in the destination path,
     * the function creates a unique file name.
     *
     * @param $url
     * @param $destinationPath
     * @param $baseFilename
     *
     * @throws \Shopware\Components\Api\Exception\CustomValidationException
     * @throws \Exception
     *
     * @return string
     */
    protected function uploadBase64File($url, $destinationPath, $baseFilename)
    {
        if (!$get_handle = fopen($url, 'r')) {
            throw new \Exception("Could not open $url for reading");
        }

        $meta = stream_get_meta_data($get_handle);
        if (!strpos($meta['mediatype'], 'image/') === false) {
            throw new ApiException\CustomValidationException('No valid media type passed for the article image : ' . $url);
        }

        $extension = str_replace('image/', '', $meta['mediatype']);
        $filename = $this->getUniqueFileName($destinationPath, $baseFilename);
        $filename .= '.' . $extension;

        if (!$put_handle = fopen("$destinationPath/$filename", 'w+')) {
            throw new \Exception("Could not open $destinationPath/$filename for writing");
        }
        while (!feof($get_handle)) {
            fwrite($put_handle, fgets($get_handle, 4096));
        }
        fclose($get_handle);
        fclose($put_handle);

        return "$destinationPath/$filename";
    }

    /**
     * @param array      $params
     * @param MediaModel $media
     *
     * @throws \Shopware\Components\Api\Exception\CustomValidationException
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Exception
     *
     * @return mixed
     */
    private function prepareMediaData($params, $media = null)
    {
        // in create mode, album is a required param
        if (!$media && (!isset($params['album']) || empty($params['album']))) {
            throw new ApiException\ParameterMissingException('album');
        }

        if (!$media && (!isset($params['file']) || empty($params['file']))) {
            throw new ApiException\ParameterMissingException('file');
        }

        if (!$media && (!isset($params['description']) || empty($params['description']))) {
            throw new ApiException\ParameterMissingException('description');
        }

        if (!$media && (!isset($params['userId']) || empty($params['userId']))) {
            $params['userId'] = 0;
        }

        if (!$media && (!isset($params['created']) || empty($params['created']))) {
            $params['created'] = new \DateTime();
        }

        // Check / set album
        if (isset($params['album'])) {
            $album = Shopware()->Models()->find(Album::class, $params['album']);
            if (!$album) {
                throw new ApiException\CustomValidationException(sprintf('Album by id %s not found', $params['album']));
            }
            $params['album'] = $album;
        }

        if (isset($params['file']) && !($params['file'] instanceof File)) {
            if (!isset($params['name'])) {
                $params['name'] = pathinfo($params['file'], PATHINFO_FILENAME);
            }
            $params['name'] = $this->getUniqueFileName($params['file'], $params['name']);

            if (!file_exists($params['file'])) {
                try {
                    $path = $this->load($params['file'], $params['name']);
                } catch (\Exception $e) {
                    throw new \Exception(sprintf('Could not load image %s', $params['file']));
                }
            } else {
                $path = $params['file'];
            }
            $params['file'] = new UploadedFile($path, $params['file']);
        }

        return $params;
    }

    /**
     * Replaces the filename in the path with the short filename because
     * the media object holds the old path with over FILENAME_LENGTH characters.
     * This is necessary because the thumbnail manager uses the path from the media object.
     *
     * @param string $oldPath
     * @param string $filename
     *
     * @return string|bool
     */
    private function prepareFilePath($oldPath, $filename)
    {
        $oldFilename = pathinfo($oldPath, PATHINFO_BASENAME);

        if (strlen($oldFilename) >= self::FILENAME_LENGTH) {
            $path = str_replace($oldFilename, $filename, $oldPath);

            return $path;
        }

        return $oldPath;
    }

    /**
     * @param string $url
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    private function saveAsTempMediaFile($url)
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'media_update');
        $localStream = fopen($tmpFile, 'wb');

        if (!$remoteStream = fopen($url, 'rb')) {
            throw new \RuntimeException(sprintf('Could not open url for reading: %s', $url));
        }

        stream_copy_to_stream($remoteStream, $localStream);

        fclose($remoteStream);
        fclose($localStream);

        return $tmpFile;
    }
}
