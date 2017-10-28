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

namespace Shopware\Bundle\PluginInstallerBundle\Context;

use Shopware\Bundle\PluginInstallerBundle\Struct\AccessTokenStruct;

class LicenceRequest extends BaseRequest
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var AccessTokenStruct
     */
    private $token;

    /**
     * @param string            $domain
     * @param AccessTokenStruct $token
     * @param string            $locale
     * @param string            $shopwareVersion
     */
    public function __construct(
        $locale,
        $shopwareVersion,
        $domain,
        AccessTokenStruct $token
    ) {
        $this->domain = $domain;
        $this->token = $token;

        parent::__construct(
            $locale,
            $shopwareVersion
        );
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return AccessTokenStruct
     */
    public function getToken()
    {
        return $this->token;
    }
}
