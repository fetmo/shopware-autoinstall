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

use Shopware\Bundle\SearchBundle\Condition\ImmediateDeliveryCondition;
use Shopware\Bundle\SearchBundle\ConditionInterface;
use Shopware\Bundle\SearchBundleDBAL\ConditionHandlerInterface;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\Bundle\SearchBundleDBAL\VariantHelper;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class ImmediateDeliveryConditionHandler implements ConditionHandlerInterface
{
    const STATE_INCLUDES_IMMEDIATE_DELIVERY_VARIANTS = 'ImmediateDeliveryVariants';

    /**
     * @var VariantHelper
     */
    private $variantHelper;

    public function __construct(VariantHelper $variantHelper)
    {
        $this->variantHelper = $variantHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsCondition(ConditionInterface $condition)
    {
        return $condition instanceof ImmediateDeliveryCondition;
    }

    /**
     * {@inheritdoc}
     */
    public function generateCondition(
        ConditionInterface $condition,
        QueryBuilder $query,
        ShopContextInterface $context
    ) {
        $this->variantHelper->joinVariants($query);

        if (!$query->hasState(self::STATE_INCLUDES_IMMEDIATE_DELIVERY_VARIANTS)) {
            $query->andWhere('allVariants.instock >= allVariants.minpurchase');
            $query->addState(self::STATE_INCLUDES_IMMEDIATE_DELIVERY_VARIANTS);
        }
    }
}
