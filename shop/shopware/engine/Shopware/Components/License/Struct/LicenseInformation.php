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

namespace Shopware\Components\License\Struct;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class LicenseInformation
{
    /**
     * @var string e.G "Shopware Enterprise Cluster"
     */
    public $label;

    /**
     * @var string e.G "SwagCommercial"
     */
    public $module;

    /**
     * @var string e.g EC @see: ShopwareEdition::$validEditions
     */
    public $edition;

    /**
     * @var string e.G sth.test.shopware.in
     */
    public $host;

    /**
     * @var int e.g 1/2/3
     */
    public $type;

    /**
     * @var string License-Key
     */
    public $license;

    /**
     * @var string the license version
     */
    public $version;

    /**
     * @var string the source which issued the license
     */
    public $source;

    /**
     * @var string when the license will expire
     */
    public $expiration;

    /**
     * @var string the issue date of the license
     */
    public $creation;

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $name => $value) {
            $this->$name = $value;
        }
    }
}
