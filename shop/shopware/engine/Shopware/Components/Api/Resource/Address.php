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

namespace Shopware\Components\Api\Resource;

use Shopware\Bundle\AccountBundle\Service\AddressServiceInterface;
use Shopware\Components\Api\Exception as ApiException;
use Shopware\Models\Country\Country;
use Shopware\Models\Country\State;
use Shopware\Models\Customer\Customer as CustomerModel;
use Shopware\Models\Shop\Repository;
use Shopware\Models\Shop\Shop as ShopModel;

/**
 * Address API Resource
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Address extends Resource
{
    /**
     * @var AddressServiceInterface
     */
    private $addressService;

    public function __construct()
    {
        $this->addressService = $this->getContainer()->get('shopware_account.address_service');
    }

    /**
     * @return \Shopware\Models\Customer\AddressRepository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository('Shopware\Models\Customer\Address');
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return array|\Shopware\Models\Customer\Address
     */
    public function getOne($id)
    {
        $this->checkPrivilege('read');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        $query = $this->getRepository()->getOne($id);

        /** @var $address \Shopware\Models\Customer\Address */
        $address = $query->getOneOrNullResult($this->getResultMode());

        if (!$address) {
            throw new ApiException\NotFoundException("Address by id $id not found");
        }

        return $address;
    }

    /**
     * @param int   $offset
     * @param int   $limit
     * @param array $criteria
     * @param array $orderBy
     *
     * @return array
     */
    public function getList($offset = 0, $limit = 25, array $criteria = [], array $orderBy = [])
    {
        $this->checkPrivilege('read');

        $query = $this->getRepository()->getListQuery($criteria, $orderBy, $limit, $offset);
        $query->setHydrationMode(self::HYDRATE_ARRAY);

        $paginator = $this->getManager()->createPaginator($query);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the address data
        $addresses = $paginator->getIterator()->getArrayCopy();

        return ['data' => $addresses, 'total' => $totalResult];
    }

    /**
     * @param array $params
     *
     * @throws ApiException\CustomValidationException
     * @throws ApiException\NotFoundException
     *
     * @return \Shopware\Models\Customer\Address
     */
    public function create(array $params)
    {
        $this->checkPrivilege('create');

        $customerId = !empty($params['customer']) ? (int) $params['customer'] : 0;
        unset($params['customer']);

        $customer = $this->getContainer()->get('models')->find(CustomerModel::class, $customerId);
        if (!$customer) {
            throw new ApiException\NotFoundException("Customer by id $customerId not found");
        }

        $this->setupContext($customer->getShop()->getId());

        if (!$params['country']) {
            throw new ApiException\CustomValidationException('A country is required.');
        }

        $params = $this->prepareAddressData($params);

        $address = new \Shopware\Models\Customer\Address();
        $address->fromArray($params);

        $this->addressService->create($address, $customer);

        if (!empty($params['__options_set_default_billing_address'])) {
            $this->addressService->setDefaultBillingAddress($address);
        }

        if (!empty($params['__options_set_default_shipping_address'])) {
            $this->addressService->setDefaultShippingAddress($address);
        }

        return $address;
    }

    /**
     * @param int   $id
     * @param array $params
     *
     * @throws \Shopware\Components\Api\Exception\ValidationException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     *
     * @return \Shopware\Models\Customer\Address
     */
    public function update($id, array $params)
    {
        $this->checkPrivilege('update');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $address \Shopware\Models\Customer\Address */
        $address = $this->getRepository()->findOneBy(['id' => $id]);

        if (!$address) {
            throw new ApiException\NotFoundException("Address by id $id not found");
        }

        $this->setupContext($address->getCustomer()->getShop()->getId());

        $params = $this->prepareAddressData($params, $address->getCustomer()->getId(), true);
        $address->fromArray($params);

        $this->addressService->update($address);

        if (!empty($params['__options_set_default_billing_address'])) {
            $this->addressService->setDefaultBillingAddress($address);
        }

        if (!empty($params['__options_set_default_shipping_address'])) {
            $this->addressService->setDefaultShippingAddress($address);
        }

        return $address;
    }

    /**
     * @param int $id
     *
     * @throws \Shopware\Components\Api\Exception\ParameterMissingException
     * @throws \Shopware\Components\Api\Exception\NotFoundException
     *
     * @return \Shopware\Models\Customer\Address
     */
    public function delete($id)
    {
        $this->checkPrivilege('delete');

        if (empty($id)) {
            throw new ApiException\ParameterMissingException();
        }

        /** @var $address \Shopware\Models\Customer\Address */
        $address = $this->getRepository()->findOneBy(['id' => $id]);

        if (!$address) {
            throw new ApiException\NotFoundException("Address by id $id not found");
        }

        $this->addressService->delete($address);

        return $address;
    }

    /**
     * Sets the correct context for e.g. validation
     *
     * @param int $shopId
     *
     * @throws \RuntimeException
     */
    private function setupContext($shopId)
    {
        /** @var Repository $shopRepository */
        $shopRepository = $this->getContainer()->get('models')->getRepository(ShopModel::class);

        $shop = $shopRepository->getActiveById($shopId);
        if (!$shop) {
            throw new \RuntimeException('A valid shopId is required.');
        }

        $shop->registerResources();
    }

    /**
     * Resolves ids to models
     *
     * @param array    $data
     * @param null|int $customerId
     * @param bool     $filter
     *
     * @throws ApiException\NotFoundException         if the given customer id in the data array is invalid
     * @throws ApiException\CustomValidationException when attempting to change a customer id on an address
     *
     * @return array
     */
    private function prepareAddressData(array $data, $customerId = null, $filter = false)
    {
        /*
         * Check if the API user tries to set an address to a *different* customer
         * if the customer is the same as the owner of the address, then no exception will be thrown
         * if it is different, depending on the case, an \InvalidArgumentException or a \LogicException will be thrown
         */
        if (isset($data['customer'])) {
            $data['customer'] = (int) $data['customer'];

            if ($data['customer'] <= 0) {
                throw new ApiException\NotFoundException('Invalid customer id');
            }

            if ($customerId !== null && $data['customer'] !== $customerId) {
                throw new ApiException\CustomValidationException('Changing a customer id on addresses is not supported');
            }

            unset($data['customer']);
        }

        $data['country'] = !empty($data['country']) ? $this->getContainer()->get('models')->find(Country::class, (int) $data['country']) : null;
        $data['state'] = !empty($data['state']) ? $this->getContainer()->get('models')->find(State::class, $data['state']) : null;

        return $filter ? array_filter($data) : $data;
    }
}
