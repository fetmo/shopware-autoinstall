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

namespace Shopware\Components\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpCache\Store as BaseStore;

/**
 * <code>
 * $httpCacheStore = new Shopware\Components\HttpCache\Store($root);
 * $httpCacheStore->purgeByHeader($name);
 * </code>
 */
class Store extends BaseStore
{
    /**
     * @var string[]
     */
    private $cacheCookies;

    /**
     * @var bool
     */
    private $lookupOptimization;

    /**
     * @param string   $root
     * @param string[] $cacheCookies
     */
    public function __construct($root, array $cacheCookies, $lookupOptimization)
    {
        $this->cacheCookies = $cacheCookies;

        parent::__construct($root);
        $this->lookupOptimization = $lookupOptimization;
    }

    /**
     * Purges data for the given Header.
     *
     * @return bool
     */
    public function purgeAll()
    {
        if (!file_exists($this->root)) {
            return false;
        }

        /** @var $file \SplFileInfo */
        foreach ($this->createRecursiveFileIterator($this->root) as $file) {
            if (!$file->isFile()) {
                continue;
            }

            // skip .gitkeep
            if ($file->getFilename() === '.gitkeep') {
                continue;
            }

            unlink($file->getPathname());
        }

        return true;
    }

    /**
     * Purges data for the given Header.
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return bool
     */
    public function purgeByHeader($name, $value = null)
    {
        // optimized purging for x-shopware-cache-id
        if ($this->lookupOptimization && $name == 'x-shopware-cache-id') {
            return $this->purgeByShopwareId($value);
        }

        $headerDir = $this->root . DIRECTORY_SEPARATOR . 'md';

        if (!file_exists($headerDir)) {
            return false;
        }

        if (isset($value)) {
            $value = ';' . $value . ';';
        }

        $result = false;

        /** @var $headerFile \SplFileInfo */
        foreach ($this->createRecursiveFileIterator($headerDir) as $headerFile) {
            if (!$headerFile->isFile()) {
                continue;
            }

            $headerData = file_get_contents($headerFile->getPathname());
            $headerData = unserialize($headerData);

            $changed = false;
            foreach ($headerData as $headerIndex => $header) {
                if (!isset($header[1][$name])) {
                    continue;
                }

                $headerValue = implode(';', $header[1][$name]);

                if (isset($value) && strpos($headerValue, $value) === false) {
                    continue;
                }
                $cacheKey = $header[1]['x-content-digest'][0];
                if (file_exists($path = $this->getPath($cacheKey))) {
                    unlink($path);
                }
                $changed = true;
                unset($headerData[$headerIndex]);
            }

            if ($changed) {
                $result = true;
                if (empty($headerData)) {
                    unlink($headerFile->getPathname());
                } else {
                    $headerData = serialize($headerData);
                    file_put_contents($headerFile->getPathname(), $headerData);
                }
            }
        }

        return $result;
    }

    /**
     * When saving a page, also save the page's cacheKey in an optimized version
     * so we can look it up more quickly
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return string
     */
    public function write(Request $request, Response $response)
    {
        $headerKey = parent::write($request, $response);

        if (!$this->lookupOptimization) {
            return $headerKey;
        }

        if (!$response->headers->has('x-shopware-cache-id') || !$response->headers->has('x-content-digest')) {
            return $headerKey;
        }

        $cacheIds = array_filter(explode(';', $response->headers->get('x-shopware-cache-id')));
        $cacheKey = $response->headers->get('x-content-digest');

        foreach ($cacheIds as $cacheId) {
            $key = 'ci' . hash('sha256', $cacheId);
            if (!$content = json_decode($this->load($key), true)) {
                $content = [];
            }

            // Storing the headerKey and the cacheKey will increase the lookup file size a bit
            // but save a lot of reads when invalidating
            $content[$cacheKey] = $headerKey;

            if (!false === $this->save($key, json_encode($content))) {
                throw new \RuntimeException("Could not write cacheKey $key");
            }
        }

        return $headerKey;
    }

    /**
     * Generate custom cache key including
     * additional state from cookie and headers.
     *
     * {@inheritdoc}
     */
    protected function generateCacheKey(Request $request)
    {
        $uri = $this->sortQueryStringParameters($request->getUri());

        foreach ($this->cacheCookies as $cookieName) {
            if ($request->cookies->has($cookieName)) {
                $uri .= '&__' . $cookieName . '=' . $request->cookies->get($cookieName);
            }
        }

        return 'md' . hash('sha256', $uri);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    private function sortQueryStringParameters($url)
    {
        $pos = strpos($url, '?');
        if ($pos === false) {
            return $url;
        }

        $urlPath = substr($url, 0, $pos + 1);
        $queryString = substr($url, $pos + 1);

        $queryParts = [];
        parse_str($queryString, $queryParts);
        ksort($queryParts, SORT_STRING);

        $queryString = http_build_query($queryParts);

        return $urlPath . $queryString;
    }

    /**
     * @param string $path the path of the directory to be iterated over
     *
     * @return \RecursiveIteratorIterator
     */
    private function createRecursiveFileIterator($path)
    {
        $directoryIterator = new \RecursiveDirectoryIterator(
            $path,
            \RecursiveDirectoryIterator::SKIP_DOTS
        );

        return new \RecursiveIteratorIterator(
            $directoryIterator,
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
    }

    /**
     * Delete all pages with the given cache id
     *
     * @param $id
     *
     * @return bool
     */
    private function purgeByShopwareId($id)
    {
        if (!$id) {
            return false;
        }

        $cacheInvalidateKey = 'ci' . hash('sha256', $id);
        $cacheInvalidatePath = $this->getPath($cacheInvalidateKey);

        if (!$content = json_decode($this->load($cacheInvalidateKey), true)) {
            return false;
        }

        // unlink all cache files which contain the given id
        foreach ($content as $cacheKey => $headerKey) {
            $contentPath = $this->getPath($cacheKey);
            $headerPath = $this->getPath($headerKey);

            @unlink($contentPath);
            @unlink($headerPath);
        }

        @unlink($cacheInvalidatePath);

        return true;
    }

    /**
     * Loads data for the given key.
     *
     * @param string $key The store key
     *
     * @return string The data associated with the key
     */
    private function load($key)
    {
        $path = $this->getPath($key);

        return is_file($path) ? file_get_contents($path) : false;
    }

    /**
     * Save data for the given key.
     *
     * @param string $key  The store key
     * @param string $data The data to store
     *
     * @return bool
     */
    private function save($key, $data)
    {
        $path = $this->getPath($key);
        if (!is_dir(dirname($path)) && false === @mkdir(dirname($path), 0777, true) && !is_dir(dirname($path))) {
            return false;
        }

        $tmpFile = tempnam(dirname($path), basename($path));
        if (false === $fp = @fopen($tmpFile, 'wb')) {
            return false;
        }
        @fwrite($fp, $data);
        @fclose($fp);

        if ($data != file_get_contents($tmpFile)) {
            return false;
        }

        if (false === @rename($tmpFile, $path)) {
            return false;
        }

        @chmod($path, 0666 & ~umask());
    }
}
