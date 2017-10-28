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

namespace Shopware\Bundle\SearchBundle\CriteriaRequestHandler;

use Enlight_Controller_Request_RequestHttp as Request;
use Shopware\Bundle\SearchBundle\Condition\CategoryCondition;
use Shopware\Bundle\SearchBundle\Condition\CustomerGroupCondition;
use Shopware\Bundle\SearchBundle\Condition\HeightCondition;
use Shopware\Bundle\SearchBundle\Condition\ImmediateDeliveryCondition;
use Shopware\Bundle\SearchBundle\Condition\IsAvailableCondition;
use Shopware\Bundle\SearchBundle\Condition\LengthCondition;
use Shopware\Bundle\SearchBundle\Condition\ManufacturerCondition;
use Shopware\Bundle\SearchBundle\Condition\PriceCondition;
use Shopware\Bundle\SearchBundle\Condition\SearchTermCondition;
use Shopware\Bundle\SearchBundle\Condition\ShippingFreeCondition;
use Shopware\Bundle\SearchBundle\Condition\VoteAverageCondition;
use Shopware\Bundle\SearchBundle\Condition\WeightCondition;
use Shopware\Bundle\SearchBundle\Condition\WidthCondition;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\CriteriaRequestHandlerInterface;
use Shopware\Bundle\SearchBundle\SearchTermPreProcessorInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

/**
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class CoreCriteriaRequestHandler implements CriteriaRequestHandlerInterface
{
    /**
     * @var \Shopware_Components_Config
     */
    private $config;

    /**
     * @var SearchTermPreProcessorInterface
     */
    private $searchTermPreProcessor;

    /**
     * @param \Shopware_Components_Config     $config
     * @param SearchTermPreProcessorInterface $searchTermPreProcessor
     */
    public function __construct(
        \Shopware_Components_Config $config,
        SearchTermPreProcessorInterface $searchTermPreProcessor
    ) {
        $this->config = $config;
        $this->searchTermPreProcessor = $searchTermPreProcessor;
    }

    /**
     * @param Request              $request
     * @param Criteria             $criteria
     * @param ShopContextInterface $context
     */
    public function handleRequest(Request $request, Criteria $criteria, ShopContextInterface $context)
    {
        $this->addLimit($request, $criteria);
        $this->addOffset($request, $criteria);

        $this->addCategoryCondition($request, $criteria);
        $this->addIsAvailableCondition($criteria);
        $this->addCustomerGroupCondition($criteria, $context);
        $this->addSearchCondition($request, $criteria);

        $this->addManufacturerCondition($request, $criteria);
        $this->addShippingFreeCondition($request, $criteria);
        $this->addImmediateDeliveryCondition($request, $criteria);
        $this->addRatingCondition($request, $criteria);
        $this->addPriceCondition($request, $criteria);

        $this->addWeightCondition($request, $criteria);
        $this->addHeightCondition($request, $criteria);
        $this->addWidthCondition($request, $criteria);
        $this->addLengthCondition($request, $criteria);
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addCategoryCondition(Request $request, Criteria $criteria)
    {
        if ($request->has('sCategory')) {
            $ids = explode('|', $request->getParam('sCategory'));

            $criteria->addBaseCondition(
                new CategoryCondition($ids)
            );
        } elseif ($request->has('categoryFilter')) {
            $ids = explode('|', $request->getParam('categoryFilter'));

            $criteria->addCondition(
                new CategoryCondition($ids)
            );
        }
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addManufacturerCondition(Request $request, Criteria $criteria)
    {
        if (!$request->has('sSupplier')) {
            return;
        }

        $manufacturers = explode(
            '|',
            $request->getParam('sSupplier')
        );

        if (!empty($manufacturers)) {
            $criteria->addCondition(new ManufacturerCondition($manufacturers));
        }
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addShippingFreeCondition(Request $request, Criteria $criteria)
    {
        $shippingFree = $request->getParam('shippingFree', null);
        if (!$shippingFree) {
            return;
        }

        $criteria->addCondition(new ShippingFreeCondition());
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addImmediateDeliveryCondition(Request $request, Criteria $criteria)
    {
        $immediateDelivery = $request->getParam('immediateDelivery', null);
        if (!$immediateDelivery) {
            return;
        }

        $criteria->addCondition(new ImmediateDeliveryCondition());
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addRatingCondition(Request $request, Criteria $criteria)
    {
        $average = $request->getParam('rating', null);
        if (!$average) {
            return;
        }

        $criteria->addCondition(new VoteAverageCondition($average));
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addPriceCondition(Request $request, Criteria $criteria)
    {
        $min = $request->getParam('priceMin', null);
        $max = $request->getParam('priceMax', null);

        if (!$min && !$max) {
            return;
        }

        $condition = new PriceCondition((float) $min, (float) $max);
        $criteria->addCondition($condition);
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addSearchCondition(Request $request, Criteria $criteria)
    {
        $term = $request->getParam('sSearch', null);
        if ($term == null) {
            return;
        }
        $term = $this->searchTermPreProcessor->process($term);
        $criteria->addBaseCondition(new SearchTermCondition($term));
    }

    /**
     * @param Criteria             $criteria
     * @param ShopContextInterface $context
     */
    private function addCustomerGroupCondition(Criteria $criteria, ShopContextInterface $context)
    {
        $condition = new CustomerGroupCondition(
            [$context->getCurrentCustomerGroup()->getId()]
        );
        $criteria->addBaseCondition($condition);
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addOffset(Request $request, Criteria $criteria)
    {
        $page = (int) $request->getParam('sPage', 1);
        $page = ($page > 0) ? $page : 1;
        $request->setParam('sPage', $page);

        $criteria->offset(
            ($page - 1) * $criteria->getLimit()
        );
    }

    /**
     * @param Request  $request
     * @param Criteria $criteria
     */
    private function addLimit(Request $request, Criteria $criteria)
    {
        $limit = (int) $request->getParam('sPerPage', $this->config->get('articlesPerPage'));
        $max = $this->config->get('maxStoreFrontLimit', null);
        if ($max) {
            $limit = min($limit, $max);
        }
        $limit = $limit >= 1 ? $limit : 1;
        $criteria->limit($limit);
    }

    /**
     * @param Criteria $criteria
     */
    private function addIsAvailableCondition(Criteria $criteria)
    {
        if (!$this->config->get('hideNoInStock')) {
            return;
        }
        $criteria->addBaseCondition(new IsAvailableCondition());
    }

    private function addWeightCondition(Request $request, Criteria $criteria)
    {
        $min = $request->getParam('minWeight', null);
        $max = $request->getParam('maxWeight', null);

        if (!$min && !$max) {
            return;
        }

        $condition = new WeightCondition((float) $min, (float) $max);
        $criteria->addCondition($condition);
    }

    private function addWidthCondition(Request $request, Criteria $criteria)
    {
        $min = $request->getParam('minWidth', null);
        $max = $request->getParam('maxWidth', null);

        if (!$min && !$max) {
            return;
        }

        $condition = new WidthCondition((float) $min, (float) $max);
        $criteria->addCondition($condition);
    }

    private function addLengthCondition(Request $request, Criteria $criteria)
    {
        $min = $request->getParam('minLength', null);
        $max = $request->getParam('maxLength', null);

        if (!$min && !$max) {
            return;
        }

        $condition = new LengthCondition((float) $min, (float) $max);
        $criteria->addCondition($condition);
    }

    private function addHeightCondition(Request $request, Criteria $criteria)
    {
        $min = $request->getParam('minHeight', null);
        $max = $request->getParam('maxHeight', null);

        if (!$min && !$max) {
            return;
        }

        $condition = new HeightCondition((float) $min, (float) $max);
        $criteria->addCondition($condition);
    }
}
