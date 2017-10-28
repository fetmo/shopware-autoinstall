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

namespace Shopware\Recovery\Update;

use DirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class Cleanup
{
    /**
     * @var bool
     */
    private $useTimer;

    /**
     * @var int
     */
    private $timeTarget;

    /**
     * @var string
     */
    private $shopwarePath;

    /**
     * @var string
     */
    private $backupDirectory;

    /**
     * @param string $shopwarePath
     * @param string $backupDirectory
     */
    public function __construct($shopwarePath, $backupDirectory)
    {
        $this->shopwarePath = $shopwarePath;
        $this->backupDirectory = $backupDirectory;
    }

    /**
     * Starts the cleanup process. If the method use the timer after 5 seconds the method stops and
     * return the deleteResult to prevent reach the maxExecution time.
     *
     * @param bool $useTimer
     *
     * @throws \Exception
     *
     * @return string
     */
    public function cleanup($useTimer = true)
    {
        $this->useTimer = $useTimer;

        if ($this->useTimer) {
            $this->timeTarget = time() + 5;
        }

        try {
            $result = $this->deleteCacheDirectories(0);
            if (!$result->getIsReady() && $this->useTimer) {
                return json_encode([
                    'deletedFiles' => $result->getFileCount(),
                    'ready' => $result->getIsReady(),
                    'error' => false,
                ]);
            }

            $result = $this->deleteTemporaryBackupDirectory($result->getFileCount());
            if ($this->useTimer) {
                return json_encode([
                    'deletedFiles' => $result->getFileCount(),
                    'ready' => $result->getIsReady(),
                    'error' => false,
                ]);
            }
        } catch (\Exception $exception) {
            if ($this->useTimer) {
                return json_encode([
                    'deletedFiles' => 0,
                    'ready' => false,
                    'error' => true,
                ]);
            }
        }
    }

    /**
     * Deletes the old cache directories
     *
     * @param $deletedFileCount
     *
     * @return DeleteResult
     */
    private function deleteCacheDirectories($deletedFileCount)
    {
        /** @var DirectoryIterator $cacheDirectoryIterator */
        $cacheDirectoryIterator = $this->getDirectoryIterator($this->shopwarePath . '/var/cache');
        $deleteResult = new DeleteResult($deletedFileCount);

        foreach ($cacheDirectoryIterator as $directory) {
            if ($directory->isDot() || $directory->isFile()) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory->getRealPath(), FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            /** @var $path \SplFileInfo */
            foreach ($iterator as $path) {
                if ($path->getFilename() == '.gitkeep') {
                    continue;
                }

                $this->delete($path, $deleteResult);

                if ($this->isTimeElapsed()) {
                    return $deleteResult;
                }
            }

            $this->delete($directory, $deleteResult);
        }

        $deleteResult->setReady();

        return $deleteResult;
    }

    /**
     * Deletes the temporary backup files of this update
     *
     * @param $deletedFileCount
     *
     * @return DeleteResult
     */
    private function deleteTemporaryBackupDirectory($deletedFileCount)
    {
        $directoryIterator = $this->getDirectoryIterator($this->backupDirectory);
        $deleteResult = new DeleteResult($deletedFileCount);

        foreach ($directoryIterator as $directory) {
            if ($directory->isDot()) {
                continue;
            }

            if ($directory->isFile()) {
                $this->delete($directory, $deleteResult);
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory->getRealPath(), FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            /** @var $path \SplFileInfo */
            foreach ($iterator as $path) {
                $this->delete($path, $deleteResult);

                if ($this->isTimeElapsed()) {
                    return $deleteResult;
                }
            }

            $this->delete($directory, $deleteResult);
        }

        $deleteResult->setReady();
        @rmdir($this->backupDirectory);
        $deleteResult->countUp();

        return $deleteResult;
    }

    /**
     * Deletes a file / directory
     *
     * @param \SplFileInfo $file
     * @param DeleteResult $deleteResult
     */
    private function delete(\SplFileInfo $file, DeleteResult &$deleteResult)
    {
        $file->isFile() ? @unlink($file->getRealPath()) : @rmdir($file->getRealPath());
        $deleteResult->countUp();
    }

    /**
     * @param $path
     *
     * @return array|DirectoryIterator
     */
    private function getDirectoryIterator($path)
    {
        if (is_dir($path)) {
            return new DirectoryIterator($path);
        }

        return [];
    }

    /**
     * @return bool
     */
    private function isTimeElapsed()
    {
        if (!$this->useTimer) {
            return false;
        }

        return $this->timeTarget < time();
    }
}
