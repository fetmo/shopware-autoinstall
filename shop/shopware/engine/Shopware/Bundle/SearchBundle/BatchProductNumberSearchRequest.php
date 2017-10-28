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

namespace Shopware\Bundle\SearchBundle;

class BatchProductNumberSearchRequest
{
    /**
     * @var array
     */
    private $criteriaList = [];

    /**
     * @var array
     */
    private $productNumberList = [];

    /**
     * @param string $key
     * @param array  $numbers
     */
    public function setProductNumbers($key, array $numbers = [])
    {
        $this->productNumberList[$key] = $numbers;
    }

    /**
     * @param string   $key
     * @param Criteria $criteria
     */
    public function setCriteria($key, Criteria $criteria)
    {
        $this->criteriaList[$key] = $criteria;
    }

    /**
     * @return array
     */
    public function getCriteriaList()
    {
        return $this->criteriaList;
    }

    /**
     * @return array
     */
    public function getProductNumbers()
    {
        return $this->productNumberList;
    }
}
