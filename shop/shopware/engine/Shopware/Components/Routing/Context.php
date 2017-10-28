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

namespace Shopware\Components\Routing;

use Enlight_Controller_Request_Request as EnlightRequest;
use Shopware\Models\Shop\Shop as ShopwareShop;
use Shopware_Components_Config as ShopwareConfig;

/**
 * Class Context
 *
 * @see http://php.net/manual/en/reflectionclass.iscloneable.php
 * @see http://api.symfony.com/2.0/Symfony/Component/Routing/RequestContext.html
 * @see \Enlight_Controller_Request_Request
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Context implements \JsonSerializable
{
    /**
     * @var array
     */
    public $params = [];
    /**
     * only for NOT mode_rewrite mode
     *
     * @var string
     */
    protected $baseFile = 'shopware.php';

    /**
     * @see \Enlight_Controller_Request_Request::getHttpHost
     *
     * @var string
     */
    protected $host = 'localhost';

    /**
     * @var string
     */
    protected $secureHost = null;

    /**
     * @var string
     */
    protected $baseUrl = '';

    /**
     * @var string
     */
    protected $secureBaseUrl = null;

    /**
     * @var bool
     */
    protected $secure = false;

    /**
     * @var bool
     */
    protected $alwaysSecure = false;

    /**
     * @var bool
     */
    protected $removeCategory = false;

    /**
     * @var bool
     */
    protected $urlToLower = false;

    /**
     * @var int|null
     */
    protected $shopId = null;

    /**
     * @var array
     */
    protected $globalParams = [];

    /**
     * Module keys for retrieving module from params
     *
     * @see \Enlight_Controller_Request_Request::$_moduleKey
     *
     * @var string
     */
    protected $moduleKey = 'module';

    /**
     * Controller key for retrieving controller from params
     *
     * @var string
     */
    protected $controllerKey = 'controller';

    /**
     * Action key for retrieving action from params
     *
     * @var string
     */
    protected $actionKey = 'action';

    /**
     * @param string $host
     * @param string $baseUrl
     * @param bool   $secure
     * @param array  $globalParams
     */
    public function __construct($host = 'localhost', $baseUrl = '', $secure = false, $globalParams = [])
    {
        $this->host = $host;
        $this->baseUrl = $baseUrl;
        $this->secure = $secure;
        $this->globalParams = $globalParams;
    }

    /**
     * @return string
     */
    public function getBaseFile()
    {
        return $this->baseFile;
    }

    /**
     * @param string $baseFile
     */
    public function setBaseFile($baseFile)
    {
        $this->baseFile = $baseFile;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        if ($host !== null) {
            $this->host = $host;
        }
    }

    /**
     * @return string
     */
    public function getSecureHost()
    {
        return $this->secureHost !== null ? $this->secureHost : $this->host;
    }

    /**
     * @param string $secureHost
     */
    public function setSecureHost($secureHost)
    {
        $this->secureHost = $secureHost;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getSecureBaseUrl()
    {
        return $this->secureBaseUrl !== null ? $this->secureBaseUrl : $this->baseUrl;
    }

    /**
     * @param string $secureBaseUrl
     */
    public function setSecureBaseUrl($secureBaseUrl)
    {
        $this->secureBaseUrl = $secureBaseUrl;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function isAlwaysSecure()
    {
        return $this->alwaysSecure;
    }

    /**
     * @param bool $alwaysSecure
     */
    public function setAlwaysSecure($alwaysSecure)
    {
        $this->alwaysSecure = $alwaysSecure;
    }

    /**
     * @return bool
     */
    public function isRemoveCategory()
    {
        return $this->removeCategory;
    }

    /**
     * @param bool $removeCategory
     */
    public function setRemoveCategory($removeCategory)
    {
        $this->removeCategory = $removeCategory;
    }

    /**
     * @return bool
     */
    public function isUrlToLower()
    {
        return $this->urlToLower;
    }

    /**
     * @param bool $urlToLower
     */
    public function setUrlToLower($urlToLower)
    {
        $this->urlToLower = $urlToLower;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @param      $name
     * @param null $default
     *
     * @return null|string
     */
    public function getParam($name, $default = null)
    {
        return isset($this->params[$name]) ? $this->params[$name] : $default;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $name
     * @param $param
     */
    public function setParam($name, $param)
    {
        $this->params[$name] = $param;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $name
     * @param string $default
     *
     * @return string
     */
    public function getGlobalParam($name, $default = null)
    {
        return isset($this->globalParams[$name]) ? $this->globalParams[$name] : $default;
    }

    /**
     * @return array
     */
    public function getGlobalParams()
    {
        return $this->globalParams;
    }

    /**
     * @param string $name
     * @param mixed  $globalParam
     */
    public function setGlobalParam($name, $globalParam)
    {
        $this->globalParams[$name] = $globalParam;
    }

    /**
     * @see Enlight_Controller_Router::setGlobalParam
     *
     * @param array $globalParams
     */
    public function setGlobalParams($globalParams)
    {
        $this->globalParams = $globalParams;
    }

    /**
     * @return string
     */
    public function getModuleKey()
    {
        return $this->moduleKey;
    }

    /**
     * @return string
     */
    public function getControllerKey()
    {
        return $this->controllerKey;
    }

    /**
     * @return string
     */
    public function getActionKey()
    {
        return $this->actionKey;
    }

    /**
     * @return Context
     */
    public static function createEmpty()
    {
        return new self();
    }

    /**
     * @param EnlightRequest $request
     *
     * @return Context
     */
    public static function createFromEnlightRequest(EnlightRequest $request)
    {
        return new self(
            $request->getHttpHost(), $request->getBaseUrl(),
            $request->isSecure(),
            [self::getGlobalParamsFromRequest($request)]
        );
    }

    /**
     * @see \Enlight_Controller_Router::setGlobalParam
     *
     * @param EnlightRequest $request
     *
     * @return array
     */
    public static function getGlobalParamsFromRequest(EnlightRequest $request)
    {
        $globalParams = [];
        if ($request->getModuleName()) {
            $globalParams['module'] = $request->getModuleName();
            if ($request->getControllerName() !== null) {
                $globalParams['controller'] = $request->getControllerName();
                if ($request->getActionName() !== null) {
                    $globalParams['action'] = $request->getActionName();
                }
            }
        }

        return $globalParams;
    }

    /**
     * @param EnlightRequest $request
     */
    public function updateFromEnlightRequest(EnlightRequest $request)
    {
        $this->setHost($request->getHttpHost());
        $this->setBaseUrl($request->getBaseUrl());
        $this->setSecure($request->isSecure());
        $this->setGlobalParams(self::getGlobalParamsFromRequest($request));
        $this->setParams($request->getQuery());
    }

    /**
     * @param ShopwareShop   $shop
     * @param ShopwareConfig $config
     *
     * @return Context
     */
    public static function createFromShop(ShopwareShop $shop, ShopwareConfig $config)
    {
        $self = new self(
            $shop->getHost(), $shop->getBaseUrl(),
            $shop->getAlwaysSecure() || $shop->getSecure(),
            []
        );
        $self->setShopId($shop->getId());
        $self->setUrlToLower($config->get('routerToLower'));
        $self->setBaseFile($config->get('baseFile'));
        $self->setAlwaysSecure($shop->getAlwaysSecure());
        $self->setRemoveCategory((bool) $config->get('routerRemoveCategory'));

        return $self;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
