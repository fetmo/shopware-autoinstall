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

namespace Shopware\Components\Plugin\Context;

use Shopware\Models\Plugin\Plugin;

class InstallContext implements \JsonSerializable
{
    const CACHE_TAG_TEMPLATE = 'template';
    const CACHE_TAG_CONFIG = 'config';
    const CACHE_TAG_ROUTER = 'router';
    const CACHE_TAG_PROXY = 'proxy';
    const CACHE_TAG_THEME = 'theme';
    const CACHE_TAG_HTTP = 'http';

    /**
     * pre defined list to invalidate simple caches
     */
    const CACHE_LIST_DEFAULT = [
        self::CACHE_TAG_TEMPLATE,
        self::CACHE_TAG_CONFIG,
        self::CACHE_TAG_ROUTER,
        self::CACHE_TAG_PROXY,
    ];

    /**
     * pre defined list to invalidate required frontend caches
     */
    const CACHE_LIST_FRONTEND = [
        self::CACHE_TAG_TEMPLATE,
        self::CACHE_TAG_THEME,
        self::CACHE_TAG_HTTP,
    ];

    /**
     * pre defined list to invalidate all caches
     */
    const CACHE_LIST_ALL = [
        self::CACHE_TAG_TEMPLATE,
        self::CACHE_TAG_CONFIG,
        self::CACHE_TAG_ROUTER,
        self::CACHE_TAG_PROXY,
        self::CACHE_TAG_THEME,
        self::CACHE_TAG_HTTP,
    ];

    /**
     * @var Plugin
     */
    private $plugin;

    /**
     * @var array
     */
    private $scheduled = [];

    /**
     * @var string
     */
    private $currentVersion;

    /**
     * @var string
     */
    private $shopwareVersion;

    /**
     * @param Plugin $plugin
     * @param string $shopwareVersion
     * @param string $currentVersion
     */
    public function __construct(Plugin $plugin, $shopwareVersion, $currentVersion)
    {
        $this->plugin = $plugin;
        $this->currentVersion = $currentVersion;
        $this->shopwareVersion = $shopwareVersion;
    }

    /**
     * @return string
     */
    public function getCurrentVersion()
    {
        return $this->currentVersion;
    }

    /**
     * @param string $requiredVersion
     *
     * @return bool
     */
    public function assertMinimumVersion($requiredVersion)
    {
        if ($this->shopwareVersion === '___VERSION___') {
            return true;
        }

        return version_compare($this->shopwareVersion, $requiredVersion, '>=');
    }

    /**
     * @param string $message
     */
    public function scheduleMessage($message)
    {
        $this->scheduled['message'] = $message;
    }

    /**
     * Adds the defer task to clear the frontend cache
     *
     * @param string[] $caches
     */
    public function scheduleClearCache(array $caches)
    {
        if (!array_key_exists('cache', $this->scheduled)) {
            $this->scheduled['cache'] = [];
        }
        $this->scheduled['cache'] = array_values(array_unique(array_merge($this->scheduled['cache'], $caches)));
    }

    /**
     * @return array
     */
    public function getScheduled()
    {
        return $this->scheduled;
    }

    /**
     * @return Plugin
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return ['scheduled' => $this->scheduled];
    }
}
