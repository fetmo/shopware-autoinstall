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

namespace Shopware\Components\Theme;

/**
 * Class LessDefinition.
 *
 * This class is used to implement own less files via plugin.
 * To add plugin less files you can listen to the event
 * `Theme_Compiler_Collect_Plugin_Less` which is thrown by
 * the \Shopware\Components\Theme\Compiler.
 * This event is a collection event, which expects that
 * the event listener returns a Doctrine\Common\Collections\ArrayCollection.
 *
 * example:
 * <code>
 *      public function addLessFiles(Enlight_Event_EventArgs $args)
 *      {
 *          $less = new \Shopware\Components\Theme\LessDefinition(
 *              //less configuration variables
 *              array(
 *                  'color1' => '#fff',
 *                  'color2' => '#000'
 *              ),
 *
 *              //less files which should be compiled
 *              array(
 *                  __DIR__ . DIRECTORY_SEPARATOR . 'event1.less',
 *                  __DIR__ . DIRECTORY_SEPARATOR . 'event2.less'
 *              ),
 *
 *              //import directory for less @import commands
 *              __DIR__
 *          );
 *          return new ArrayCollection(array($less));
 *      }
 * </code>
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class LessDefinition
{
    /**
     * Array of less files which should be concatenated and compiled.
     * The compiler requires the full file path.
     *
     * @var array
     */
    private $files = [];

    /**
     * Directory which should be set as import directory.
     * If no `@import` used, the import directory can be ignored
     *
     * @var string
     */
    private $importDirectory = null;

    /**
     * Less variables for the compiler.
     * Has to be an key value array.
     *
     * @example
     * array(
     *    'fontColor' => '#fff',
     *    'background' => '#000',
     *    ...
     * )
     *
     * @var array
     */
    private $config;

    /**
     * @param array $config          contains the less variables, has to be a key value array
     * @param array $files           contains the full file name paths
     * @param null  $importDirectory Full path to the import directory for less @import commands
     */
    public function __construct(array $config = [], array $files = [], $importDirectory = null)
    {
        $this->config = $config;
        $this->files = $files;
        $this->importDirectory = $importDirectory;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return string[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param string $importDirectory
     */
    public function setImportDirectory($importDirectory)
    {
        $this->importDirectory = $importDirectory;
    }

    /**
     * @return string
     */
    public function getImportDirectory()
    {
        return $this->importDirectory;
    }
}
