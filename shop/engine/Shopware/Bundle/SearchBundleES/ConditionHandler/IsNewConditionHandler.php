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

namespace Shopware\Bundle\SearchBundleES\ConditionHandler;

use ONGR\ElasticsearchDSL\Query\RangeQuery;
use ONGR\ElasticsearchDSL\Search;
use Shopware\Bundle\SearchBundle\Condition\IsNewCondition;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\CriteriaPartInterface;
use Shopware\Bundle\SearchBundleES\PartialConditionHandlerInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class IsNewConditionHandler implements PartialConditionHandlerInterface
{
    /**
     * @var \Shopware_Components_Config
     */
    private $config;

    /**
     * @param \Shopware_Components_Config $config
     */
    public function __construct(\Shopware_Components_Config $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(CriteriaPartInterface $criteriaPart)
    {
        return $criteriaPart instanceof IsNewCondition;
    }

    /**
     * {@inheritdoc}
     */
    public function handleFilter(
        CriteriaPartInterface $criteriaPart,
        Criteria $criteria,
        Search $search,
        ShopContextInterface $context
    ) {
        $search->addFilter(
            $this->createQuery()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function handlePostFilter(
        CriteriaPartInterface $criteriaPart,
        Criteria $criteria,
        Search $search,
        ShopContextInterface $context
    ) {
        $search->addPostFilter(
            $this->createQuery()
        );
    }

    /**
     * @return RangeQuery
     */
    private function createQuery()
    {
        $dayLimit = (int) $this->config->get('markAsNew');
        $timestamp = strtotime('-' . $dayLimit . ' days');

        return new RangeQuery('formattedCreatedAt', [
            'gte' => date('Y-m-d', $timestamp),
            'lte' => date('Y-m-d'),
        ]);
    }
}
