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

namespace Shopware\Bundle\CustomerSearchBundle\Condition;

use Shopware\Bundle\SearchBundle\ConditionInterface;

class HasTotalOrderAmountCondition implements ConditionInterface
{
    /**
     * @var float
     */
    protected $minimumOrderAmount;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @param float  $minimumOrderAmount
     * @param string $operator
     */
    public function __construct($minimumOrderAmount, $operator = ConditionInterface::OPERATOR_GTE)
    {
        $this->minimumOrderAmount = $minimumOrderAmount;
        $this->operator = $operator;
    }

    /**
     * @return float
     */
    public function getMinimumOrderAmount()
    {
        return $this->minimumOrderAmount;
    }

    public function getName()
    {
        return 'HasTotalOrderAmountCondition';
    }

    public function getOperator()
    {
        return $this->operator;
    }
}
