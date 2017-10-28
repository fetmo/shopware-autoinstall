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

namespace Shopware\Bundle\AccountBundle\Service;

use Shopware\Models\Customer\Address;
use Shopware\Models\Customer\Customer;

interface AddressServiceInterface
{
    /**
     * @param Address  $address
     * @param Customer $customer
     */
    public function create(Address $address, Customer $customer);

    /**
     * @param Address $address
     */
    public function update(Address $address);

    /**
     * @param Address $address
     */
    public function delete(Address $address);

    /**
     * Sets the address to the default billing address in the customer model
     *
     * @param Address $address
     */
    public function setDefaultBillingAddress(Address $address);

    /**
     * Sets the address to the default shipping address in the customer model
     *
     * @param Address $address
     */
    public function setDefaultShippingAddress(Address $address);
}
