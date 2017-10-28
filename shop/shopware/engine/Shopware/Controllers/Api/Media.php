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

use Shopware\Components\Api\Exception as ApiException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class Shopware_Controllers_Api_Media extends Shopware_Controllers_Api_Rest
{
    /**
     * @var Shopware\Components\Api\Resource\Media
     */
    protected $resource = null;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('media');
    }

    /**
     * Get list of media
     *
     * GET /api/media/
     */
    public function indexAction()
    {
        $limit = $this->Request()->getParam('limit', 1000);
        $offset = $this->Request()->getParam('start', 0);
        $sort = $this->Request()->getParam('sort', []);
        $filter = $this->Request()->getParam('filter', []);

        $result = $this->resource->getList($offset, $limit, $filter, $sort);

        $this->View()->assign($result);
        $this->View()->assign('success', true);
    }

    /**
     * Get one media
     *
     * GET /api/media/{id}
     */
    public function getAction()
    {
        $id = $this->Request()->getParam('id');

        $media = $this->resource->getOne($id);

        $this->View()->assign('data', $media);
        $this->View()->assign('success', true);
    }

    /**
     * Create new media
     *
     * POST /api/media
     */
    public function postAction()
    {
        $params = $this->Request()->getPost();
        $params = $this->prepareUploadedFile($params);
        $params = $this->prepareFallbackUser($params);

        $media = $this->resource->create($params);

        $location = $this->apiBaseUrl . 'media/' . $media->getId();
        $data = [
            'id' => $media->getId(),
            'location' => $location,
        ];

        $this->View()->assign(['success' => true, 'data' => $data]);
        $this->Response()->setHeader('Location', $location);
    }

    /**
     * Update media
     *
     * PUT /api/media/{id}
     */
    public function putAction()
    {
        $id = $this->Request()->getParam('id');
        $params = $this->Request()->getPost();

        $media = $this->resource->update($id, $params);

        $location = $this->apiBaseUrl . 'media/' . $media->getId();
        $data = [
            'id' => $media->getId(),
            'location' => $location,
        ];

        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    /**
     * Delete media
     *
     * DELETE /api/media/{id}
     */
    public function deleteAction()
    {
        $id = $this->Request()->getParam('id');

        $this->resource->delete($id);

        $this->View()->assign(['success' => true]);
    }

    /**
     * @param array $params
     *
     * @throws ApiException\CustomValidationException
     * @throws Exception
     *
     * @return array
     */
    private function prepareUploadedFile(array $params)
    {
        $fileBag = new FileBag($_FILES);

        // Check for a POSTed file
        if ($fileBag->has('file')) {
            /** @var UploadedFile $file */
            $file = $fileBag->get('file');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();

            if ($file->getError() !== UPLOAD_ERR_OK) {
                throw new \Exception(sprintf('Could not upload file "%s"', $file->getClientOriginalName()));
            }

            // use custom name if provided
            if (!empty($params['name'])) {
                // Use the provided name to overwrite the file name, but keep the extensions to allow
                // automatic detection of the file type
                $fileName = $params['name'] . '.' . $fileExtension;
            }

            $params['name'] = $this->resource->getUniqueFileName($file->getPathname(), $fileName);
            $params['file'] = new UploadedFile(
                $file->getPathname(),
                $params['name'],
                $file->getClientMimeType(),
                $file->getClientSize(),
                $file->getError()
            );
        }

        return $params;
    }

    /**
     * Use the ID of the authenticated user as a fallback 'userId'
     *
     * @param array $params
     *
     * @return array
     */
    private function prepareFallbackUser(array $params)
    {
        if (empty($params['userId'])) {
            $params['userId'] = $this->get('auth')->getIdentity()->id;
        }

        return $params;
    }
}
