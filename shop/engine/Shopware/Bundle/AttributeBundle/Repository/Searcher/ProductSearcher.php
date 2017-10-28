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

namespace Shopware\Bundle\AttributeBundle\Repository\Searcher;

use Shopware\Bundle\AttributeBundle\Repository\SearchCriteria;
use Shopware\Models\Article\Detail;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.com)
 */
class ProductSearcher extends GenericSearcher
{
    protected function createQuery(SearchCriteria $criteria)
    {
        $builder = $this->entityManager->createQueryBuilder();
        $builder->select($this->getIdentifierField());
        $builder->from(Detail::class, 'entity');
        $builder->innerJoin('entity.article', 'article');

        if ($criteria->entity === 'Shopware\Models\Article\Article') {
            $builder->andWhere('entity.kind = 1');
        }

        $builder->setAlias('entity');

        return $builder;
    }

    /**
     * @param SearchCriteria $criteria
     *
     * @return array
     */
    protected function getSearchFields(SearchCriteria $criteria)
    {
        return ['entity.number', 'article.name'];
    }

    /**
     * @return string
     */
    protected function getIdentifierField()
    {
        return 'entity.number';
    }
}
