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

namespace Shopware\Bundle\SearchBundleDBAL\ConditionHandler;

use Shopware\Bundle\SearchBundle\Condition\WeightCondition;
use Shopware\Bundle\SearchBundle\ConditionInterface;
use Shopware\Bundle\SearchBundleDBAL\ConditionHandlerInterface;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\Bundle\SearchBundleDBAL\VariantHelper;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

class WeightConditionHandler implements ConditionHandlerInterface
{
    /**
     * @var VariantHelper
     */
    private $variantHelper;

    /**
     * @param VariantHelper $variantHelper
     */
    public function __construct(VariantHelper $variantHelper)
    {
        $this->variantHelper = $variantHelper;
    }

    public function supportsCondition(ConditionInterface $condition)
    {
        return $condition instanceof WeightCondition;
    }

    public function generateCondition(
        ConditionInterface $condition,
        QueryBuilder $query,
        ShopContextInterface $context
    ) {
        /* @var WeightCondition $condition */
        $this->variantHelper->joinVariants($query);

        $min = ':minLength' . md5(json_encode($condition));
        $max = ':maxLength' . md5(json_encode($condition));

        if ($condition->getMinWeight() > 0) {
            $query->andWhere('allVariants.weight >= ' . $min);
            $query->setParameter($min, $condition->getMinWeight());
        }

        if ($condition->getMaxWeight() > 0) {
            $query->andWhere('allVariants.weight <= ' . $max);
            $query->setParameter($max, $condition->getMaxWeight());
        }
    }
}
