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

use Shopware\Models\Search\CustomFacet;

class Shopware_Controllers_Backend_CustomFacet extends Shopware_Controllers_Backend_Application
{
    protected $model = CustomFacet::class;

    public function changePositionAction()
    {
        $id = (int) $this->Request()->getParam('id');
        $position = (int) $this->Request()->getParam('position');

        $connection = $this->container->get('dbal_connection');

        $connection->executeUpdate(
            'UPDATE s_search_custom_facet SET position = position - 1 WHERE position <= :position',
            [':position' => $position]
        );

        $connection->executeUpdate(
            'UPDATE s_search_custom_facet SET position = :position WHERE id = :id',
            [':position' => $position, ':id' => $id]
        );

        $this->View()->assign('success', true);
    }

    public function copyCategorySettingsAction()
    {
        $categoryId = (int) $this->Request()->getParam('categoryId');

        $connection = $this->container->get('dbal_connection');

        $data = $connection->fetchAssoc(
            'SELECT `hidefilter`, `facet_ids` FROM s_categories WHERE id = :id',
            [':id' => $categoryId]
        );

        $connection->executeUpdate(
            'UPDATE s_categories SET `hidefilter` = :hideFilter, `facet_ids` = :facetIds WHERE path LIKE :path',
            [
                ':hideFilter' => (int) $data['hideFilter'],
                ':facetIds' => (string) $data['facet_ids'],
                ':path' => '%|' . $categoryId . '|%',
            ]
        );

        $this->View()->assign('success', true);
    }
}
