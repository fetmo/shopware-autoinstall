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

use Shopware\Models\Attribute\Customer as CustomerAttribute;
use Shopware\Models\Customer\Customer;

class Shopware_Controllers_Backend_CustomerQuickView extends Shopware_Controllers_Backend_Application
{
    protected $model = Customer::class;
    protected $alias = 'customer';

    /**
     * {@inheritdoc}
     */
    public function deleteAction()
    {
        if (!$this->_isAllowed('delete', 'customer')) {
            throw new Enlight_Controller_Exception('You do not have sufficient rights to delete a customer.', 401);
        }
        parent::deleteAction();
    }

    /**
     * {@inheritdoc}
     */
    public function save($data)
    {
        if (!$this->_isAllowed('save', 'customer')) {
            throw new Enlight_Controller_Exception('You do not have sufficient rights to update a customer.', 401);
        }
        parent::save($data);
    }

    /**
     * {@inheritdoc}
     */
    public function detailAction()
    {
        if (!$this->_isAllowed('detail', 'customer')) {
            throw new Enlight_Controller_Exception('You do not have sufficient rights to delete a customer.', 401);
        }
        parent::detailAction();
    }

    /**
     * {@inheritdoc}
     */
    public function listAction()
    {
        if (!$this->_isAllowed('read', 'customer')) {
            throw new Enlight_Controller_Exception('You do not have sufficient rights to view the list of customers.', 401);
        }
        parent::listAction();
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $this->get('dbal_connection')->executeQuery(
            'DELETE FROM s_customer_streams_mapping WHERE customer_id = :id',
            [':id' => $id]
        );

        $this->get('dbal_connection')->executeQuery(
            'DELETE FROM s_customer_search_index WHERE id = :id',
            [':id' => $id]
        );

        return parent::delete($id);
    }

    /**
     * {@inheritdoc}
     */
    protected function getListQuery()
    {
        $query = $this->container->get('models')->createQueryBuilder();

        $query->select([
            'customer.id',
            'customer.number',
            'customer.active',
            'customer.email',
            'customer.firstLogin',
            'customer.lastLogin',
            'customer.accountMode',
            'customer.newsletter',
            'customer.lockedUntil',
            'customer.salutation',
            'customer.title',
            'customer.firstname',
            'customer.lastname',
            'customer.birthday',
            'shops.name as shop',
            'groups.name as customerGroup',
            'billing.zipcode',
            'billing.city',
            'billing.company',
        ]);

        $query->from(Customer::class, 'customer');
        $query->leftJoin('customer.shop', 'shops');
        $query->leftJoin('customer.defaultBillingAddress', 'billing');
        $query->leftJoin('customer.attribute', 'attribute');
        $query->leftJoin('customer.group', 'groups');

        $filters = $this->Request()->getParam('filter', []);
        $search = null;
        foreach ($filters as $index => $filter) {
            if ($filter['property'] === 'search') {
                $search = $filter['value'];
                break;
            }
        }

        if ($search) {
            $builder = $this->container->get('shopware.model.search_builder');
            $builder->addSearchTerm($query, $search, [
                'customer.number^2',
                'customer.email^2',
                'customer.firstname^3',
                'customer.lastname^3',
                'billing.zipcode^0.5',
                'billing.city^0.5',
                'billing.company^0.5',
            ]);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    protected function getList($offset, $limit, $sort = [], $filter = [], array $wholeParams = [])
    {
        foreach ($filter as $index => $f) {
            if ($f['property'] === 'search') {
                unset($filter[$index]);
            }
        }

        $list = parent::getList($offset, $limit, $sort, $filter, $wholeParams);

        $ids = array_column($list['data'], 'id');

        $attributes = $this->fetchAttributes($ids);

        foreach ($list['data'] as &$row) {
            $id = (int) $row['id'];

            if (array_key_exists($id, $attributes)) {
                $row['attribute'] = $attributes[$id];
            }
        }

        return $list;
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelFields($model, $alias = null)
    {
        $fields = parent::getModelFields($model, $alias);
        if ($model !== Customer::class) {
            return $fields;
        }
        $fields = array_merge($fields, [
            'customerGroup' => ['alias' => 'groups.id', 'type' => 'int'],
            'shop' => ['alias' => 'shops.id', 'type' => 'int'],
            'zipCode' => ['alias' => 'billing.zipcode', 'type' => 'string'],
            'city' => ['alias' => 'billing.city', 'type' => 'string'],
            'company' => ['alias' => 'billing.company', 'type' => 'string'],
        ]);

        return $fields;
    }

    private function fetchAttributes(array $ids)
    {
        $query = $this->container->get('models')->createQueryBuilder();
        $query->select(['attribute']);
        $query->from(CustomerAttribute::class, 'attribute', 'attribute.customerId');
        $query->where('attribute.customerId IN (:ids)');
        $query->setParameter(':ids', $ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);

        return $query->getQuery()->getArrayResult();
    }
}
