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

namespace Shopware\Components\Thumbnail;

use Shopware\Bundle\MediaBundle\MediaServiceInterface;
use Shopware\Components\Thumbnail\Generator\GeneratorInterface;
use Shopware\Models\Media\Media;
use Shopware\Models\Media\Settings;

/**
 * Shopware Thumbnail Manager
 *
 * This class handles the generation of thumbnails.
 * It uses a passed thumbnail generator which will be used for creating the thumbnails.
 * It expects a passed media object for further information handling.
 *
 * Class Manager
 *
 * @category    Shopware
 *
 * @copyright   Copyright (c) shopware AG (http://www.shopware.de)
 */
class Manager
{
    /**
     * This generator will be used for the thumbnail creation itself
     *
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var \Enlight_Event_EventManager
     */
    protected $eventManager;

    /**
     * @var MediaServiceInterface
     */
    private $mediaService;

    /**
     * The constructor for the thumbnail manager.
     * Expects a passed generator and the media/destination directory
     *
     * @param GeneratorInterface          $generator
     * @param string                      $rootDir      - the full path to the shopware directory e.g. /var/www/shopware/
     * @param \Enlight_Event_EventManager $eventManager
     * @param MediaServiceInterface       $mediaService
     */
    public function __construct(GeneratorInterface $generator, $rootDir, \Enlight_Event_EventManager $eventManager, MediaServiceInterface $mediaService)
    {
        $this->generator = $generator;
        $this->rootDir = $rootDir;
        $this->eventManager = $eventManager;
        $this->mediaService = $mediaService;
    }

    /**
     * Method to generate a single thumbnail.
     *
     * First it loads an image from the media path,
     * then resizes it and saves it to the default thumbnail directory
     *
     * @param Media $media
     * @param array $thumbnailSizes  - array of all sizes which needs to be generated
     * @param bool  $keepProportions - Whether or not keeping the proportions of the original image, the size can be affected when true
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function createMediaThumbnail(Media $media, $thumbnailSizes = [], $keepProportions = false)
    {
        if ($media->getType() !== $media::TYPE_IMAGE) {
            throw new \Exception('File is not an image.');
        }

        if (empty($thumbnailSizes)) {
            $thumbnailSizes = $this->getThumbnailSizesFromMedia($media);
            $thumbnailSizes = array_merge($thumbnailSizes, $media->getDefaultThumbnails());
        }

        $albumSettings = $this->getAlbumSettingsFromMedia($media);
        if ($albumSettings) {
            $highDpi = $albumSettings->isThumbnailHighDpi();
            $standardQuality = $albumSettings->getThumbnailQuality();
            $highDpiQuality = $albumSettings->getThumbnailHighDpiQuality();
        } else {
            $highDpi = false;
            $standardQuality = 90;
            $highDpiQuality = 90;
        }

        $thumbnailSizes = $this->uniformThumbnailSizes($thumbnailSizes);

        $imagePath = $media->getPath();

        $parameters = [
            'path' => $imagePath,
            'sizes' => $thumbnailSizes,
            'keepProportions' => $keepProportions,
        ];

        if ($this->eventManager) {
            $parameters = $this->eventManager->filter(
                'Shopware_Components_Thumbnail_Manager_CreateThumbnail',
                $parameters,
                ['subject' => $this, 'media' => $media]
            );
        }

        foreach ($parameters['sizes'] as $size) {
            $suffix = $size['width'] . 'x' . $size['height'];

            $destinations = $this->getDestination($media, $suffix);
            foreach ($destinations as $destination) {
                $this->generator->createThumbnail(
                    $parameters['path'],
                    $destination,
                    $size['width'],
                    $size['height'],
                    $parameters['keepProportions'],
                    $standardQuality
                );
            }
        }

        if (!$highDpi) {
            return;
        }

        foreach ($parameters['sizes'] as $size) {
            $suffix = $size['width'] . 'x' . $size['height'] . '@2x';

            $destinations = $this->getDestination($media, $suffix);
            foreach ($destinations as $destination) {
                $this->generator->createThumbnail(
                    $parameters['path'],
                    $destination,
                    $size['width'] * 2,
                    $size['height'] * 2,
                    $parameters['keepProportions'],
                    $highDpiQuality
                );
            }
        }
    }

    /**
     * Helper function which returns the thumbnail paths of a single
     * media object.
     *
     * @param $name
     * @param $type
     * @param $extension
     * @param array $sizes
     *
     * @return array
     */
    public function getMediaThumbnails($name, $type, $extension, array $sizes)
    {
        $sizes = $this->uniformThumbnailSizes($sizes);

        $thumbnails = [];

        foreach ($sizes as $size) {
            $suffix = $size['width'] . 'x' . $size['height'];

            $path = $this->getPathOfType($type) . '/thumbnail/';

            $thumbnails[] = [
                'maxWidth' => $size['width'],
                'maxHeight' => $size['height'],
                'source' => $path . $name . '_' . $suffix . '.' . $extension,
                'retinaSource' => $path . $name . '_' . $suffix . '@2x' . '.' . $extension,
            ];
        }

        return $thumbnails;
    }

    /**
     * Deletes all thumbnails from the given media object
     *
     * @param Media $media
     */
    public function removeMediaThumbnails(Media $media)
    {
        $thumbnails = array_merge(
            array_values($media->getThumbnailFilePaths()),
            array_values($media->getThumbnailFilePaths(true))
        );

        foreach ($thumbnails as $thumbnail) {
            $thumbnailPath = $this->rootDir . '/' . $thumbnail;

            if ($this->mediaService->has($thumbnailPath)) {
                $this->mediaService->delete($thumbnailPath);
            }
        }
    }

    /**
     * Returns an array with a jpg and original extension path if its not a jpg
     *
     * @param Media $media
     * @param $suffix
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function getDestination(Media $media, $suffix)
    {
        $thumbnailDir = $this->getThumbnailDir($media);

        $fileName = str_replace(
            '.' . $media->getExtension(),
            '_' . $suffix . '.' . 'jpg',
            $media->getFileName()
        );

        $fileNames = [
            'jpg' => $thumbnailDir . $fileName,
        ];

        // create native extension thumbnail
        if ($media->getExtension() !== 'jpg') {
            $fileName = str_replace(
                '.' . $media->getExtension(),
                '_' . $suffix . '.' . $media->getExtension(),
                $media->getFileName()
            );

            $fileNames[$media->getExtension()] = $thumbnailDir . $fileName;
        }

        return $fileNames;
    }

    /**
     * Returns the full path of a thumbnail dir according to the media type
     * The default path for images after the root dir would be media/image/thumbnail/
     *
     * @param $media
     *
     * @return string
     */
    protected function getThumbnailDir($media)
    {
        return '/media/' . strtolower($media->getType()) . '/thumbnail/';
    }

    /**
     * Brings the passed sizes into a uniform format.
     *
     * The passed param has to be an array with one or more sizes.
     * These sizes can have following formats:
     *
     * '100x110'
     * array(120, 130)
     * array(140)
     * array('width' => 150, 'height' => 160)
     *
     * The method returns an array of sizes with following format:
     *
     * array('width' => 100, 'height' => 200)
     *
     * @param $thumbnailSizes
     *
     * @return array
     */
    protected function uniformThumbnailSizes($thumbnailSizes)
    {
        foreach ($thumbnailSizes as &$size) {
            if (is_string($size)) {
                if (strpos($size, 'x') !== false) {
                    $size = $this->stringSizeToArray($size);
                } else {
                    $size = ['width' => $size, 'height' => $size];
                }
            } else {
                if (is_array($size) && !array_key_exists('width', $size)) {
                    $size = ['width' => $size[0], 'height' => isset($size[1]) ? $size[1] : $size[0]];
                }

                if (is_int($size)) {
                    $size = ['width' => $size[0], 'height' => isset($size[1]) ? $size[1] : $size[0]];
                }
            }
        }

        return $thumbnailSizes;
    }

    private function getPathOfType($type)
    {
        return 'media/' . strtolower($type);
    }

    /**
     * Returns an array with width and height gained
     * from a string in a format like 100x200
     *
     * @param $size
     *
     * @return array
     */
    private function stringSizeToArray($size)
    {
        $size = explode('x', $size);

        return ['width' => $size[0], 'height' => $size[1]];
    }

    /**
     * @param Media $media
     *
     * @throws \Exception
     *
     * @return array
     */
    private function getThumbnailSizesFromMedia(Media $media)
    {
        $album = $media->getAlbum();

        if (!$album) {
            throw new \Exception('No album configured for the passed media object and no size passed!');
        }

        $settings = $album->getSettings();

        if (!$settings) {
            throw new \Exception('No settings configured in the album of the given media object!');
        }

        $thumbnailSizes = $settings->getThumbnailSize();

        //when no sizes are defined in the album
        if (empty($thumbnailSizes) || empty($thumbnailSizes[0])) {
            $thumbnailSizes = [];
        }

        return $thumbnailSizes;
    }

    /**
     * @param Media $media
     *
     * @return Settings|null
     */
    private function getAlbumSettingsFromMedia(Media $media)
    {
        $album = $media->getAlbum();

        if (!$album) {
            return null;
        }

        $settings = $album->getSettings();

        if (!$settings) {
            return null;
        }

        return $settings;
    }
}
