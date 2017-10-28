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

namespace Shopware\Bundle\PluginInstallerBundle\Service;

use Symfony\Component\Filesystem\Filesystem;

class PluginExtractor
{
    /**
     * @var string
     */
    private $pluginDir;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string[]
     */
    private $pluginDirectories = [];

    /**
     * @param string     $pluginDir
     * @param Filesystem $filesystem
     * @param string[]   $pluginDirectories
     */
    public function __construct($pluginDir, Filesystem $filesystem, array $pluginDirectories = [])
    {
        $this->pluginDir = $pluginDir;
        $this->filesystem = $filesystem;
        $this->pluginDirectories = $pluginDirectories;
    }

    /**
     * Extracts the provided zip file to the provided destination
     *
     * @param \ZipArchive $archive
     *
     * @throws \Exception
     */
    public function extract($archive)
    {
        $destination = $this->pluginDir;

        if (!is_writable($destination)) {
            throw new \Exception(
                'Destination directory is not writable'
            );
        }

        $prefix = $this->getPluginPrefix($archive);
        $this->validatePluginZip($prefix, $archive);

        $oldFile = $this->findOldFile($prefix);
        $backupFile = $this->createBackupFile($oldFile);

        try {
            $archive->extractTo($destination);

            if ($backupFile !== false) {
                $this->filesystem->remove($backupFile);
            }

            unlink($archive->filename);
        } catch (\Exception $e) {
            if ($backupFile !== false) {
                $this->filesystem->rename($backupFile, $oldFile);
            }
            throw $e;
        }

        $this->clearOpcodeCache();
    }

    /**
     * Iterates all files of the provided zip archive
     * path and validates the plugin namespace, directory traversal
     * and multiple plugin directories.
     *
     * @param string      $prefix
     * @param \ZipArchive $archive
     */
    private function validatePluginZip($prefix, \ZipArchive $archive)
    {
        for ($i = 2; $i < $archive->numFiles; ++$i) {
            $stat = $archive->statIndex($i);

            $this->assertNoDirectoryTraversal($stat['name']);
            $this->assertPrefix($stat['name'], $prefix);
        }
    }

    /**
     * @param \ZipArchive $archive
     *
     * @return string
     */
    private function getPluginPrefix(\ZipArchive $archive)
    {
        $entry = $archive->statIndex(0);

        return explode('/', $entry['name'])[0];
    }

    /**
     * Clear opcode caches to make sure that the
     * updated plugin files are used in the following requests.
     */
    private function clearOpcodeCache()
    {
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        if (function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
    }

    /**
     * @param string $filename
     * @param string $prefix
     */
    private function assertPrefix($filename, $prefix)
    {
        if (strpos($filename, $prefix) !== 0) {
            throw new \RuntimeException(
                sprintf(
                    'Detected invalid file/directory %s in the plugin zip: %s',
                    $filename,
                    $prefix
                )
            );
        }
    }

    /**
     * @param $filename
     */
    private function assertNoDirectoryTraversal($filename)
    {
        if (strpos($filename, '../') !== false) {
            throw new \RuntimeException(
                sprintf('Directory Traversal detected')
            );
        }
    }

    /**
     * @param string $pluginName
     *
     * @return bool|string
     */
    private function findOldFile($pluginName)
    {
        $dir = $this->pluginDir . '/' . $pluginName;
        if ($this->filesystem->exists($dir)) {
            return $dir;
        }

        foreach ($this->pluginDirectories as $directory) {
            $namespaces = ['Core', 'Frontend', 'Backend'];
            foreach ($namespaces as $namespace) {
                $dir = $directory . $namespace . '/' . $pluginName;

                if ($this->filesystem->exists($dir)) {
                    return $dir;
                }
            }
        }

        return false;
    }

    /**
     * @param string $oldFile
     *
     * @return bool|string
     */
    private function createBackupFile($oldFile)
    {
        if ($oldFile === false) {
            return false;
        }

        $backupFile = $oldFile . '.' . uniqid();
        $this->filesystem->rename($oldFile, $backupFile);
        rename($oldFile, $backupFile);

        return $backupFile;
    }
}
