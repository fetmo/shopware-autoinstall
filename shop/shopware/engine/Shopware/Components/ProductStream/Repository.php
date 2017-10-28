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

namespace Shopware\Components\ProductStream;

use Doctrine\DBAL\Connection;
use Shopware\Bundle\SearchBundle\Condition\OrdernumberCondition;
use Shopware\Bundle\SearchBundle\ConditionInterface;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\SortingInterface;
use Shopware\Components\LogawareReflectionHelper;

class Repository implements RepositoryInterface
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * @var LogawareReflectionHelper
     */
    private $reflector;

    /**
     * @param Connection               $conn
     * @param LogawareReflectionHelper $reflector
     */
    public function __construct(Connection $conn, LogawareReflectionHelper $reflector)
    {
        $this->conn = $conn;
        $this->reflector = $reflector;
    }

    /**
     * @param Criteria $criteria
     * @param int      $productStreamId
     */
    public function prepareCriteria(Criteria $criteria, $productStreamId)
    {
        $productStream = $this->getStreamById($productStreamId);

        if ($productStream['type'] == 1) {
            $this->prepareConditionStream($productStream, $criteria);

            return;
        }

        if ($productStream['type'] == 2) {
            $this->prepareSelectionStream($productStream, $criteria);

            return;
        }
    }

    /**
     * @param array $serializedConditions
     *
     * @return object[]
     */
    public function unserialize($serializedConditions)
    {
        return $this->reflector->unserialize($serializedConditions, 'Serialization error in Product stream');
    }

    /**
     * @param array    $productStream
     * @param Criteria $criteria
     */
    private function prepareConditionStream(array $productStream, Criteria $criteria)
    {
        $this->assignConditions($productStream, $criteria);

        $sortings = $criteria->getSortings();
        if (empty($sortings)) {
            $this->assignSortings($productStream, $criteria);
        }
    }

    /**
     * @param array    $productStream
     * @param Criteria $criteria
     */
    private function prepareSelectionStream(array $productStream, Criteria $criteria)
    {
        $ordernumbers = $this->getOrdernumbers($productStream['id']);

        $criteria->addBaseCondition(new OrdernumberCondition($ordernumbers));

        $sortings = $criteria->getSortings();
        if (empty($sortings)) {
            $this->assignSortings($productStream, $criteria);
        }
    }

    /**
     * @param int $productStreamId
     *
     * @return string[]
     */
    private function getOrdernumbers($productStreamId)
    {
        $query = <<<'SQL'
SELECT
    s_articles_details.ordernumber
FROM s_product_streams_selection
INNER JOIN s_articles_details ON s_product_streams_selection.article_id = s_articles_details.articleID
WHERE stream_id = :productStreamId
AND s_articles_details.kind = 1
SQL;

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['productStreamId' => $productStreamId]);

        $result = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        return $result;
    }

    /**
     * @param int $productStreamId
     *
     * @return array
     */
    private function getStreamById($productStreamId)
    {
        $row = $this->conn->fetchAssoc(
            'SELECT streams.*, customSorting.sortings as customSortings
             FROM s_product_streams streams
             LEFT JOIN s_search_custom_sorting customSorting
                 ON customSorting.id = streams.sorting_id
             WHERE streams.id = :productStreamId
             LIMIT 1',
            ['productStreamId' => $productStreamId]
        );

        return $row;
    }

    /**
     * @param array    $productStream
     * @param Criteria $criteria
     */
    private function assignSortings(array $productStream, Criteria $criteria)
    {
        $sorting = $productStream['sorting'];
        if (!empty($productStream['customSortings'])) {
            $sorting = $productStream['customSortings'];
        }

        $serializedSortings = json_decode($sorting, true);

        /** @var SortingInterface[] $sortings */
        $sortings = $this->unserialize($serializedSortings);
        foreach ($sortings as $sorting) {
            $criteria->addSorting($sorting);
        }
    }

    /**
     * @param array    $productStream
     * @param Criteria $criteria
     */
    private function assignConditions(array $productStream, Criteria $criteria)
    {
        $serializedConditions = json_decode($productStream['conditions'], true);
        $conditions = $this->unserialize($serializedConditions);
        /** @var ConditionInterface $conditions */
        foreach ($conditions as $condition) {
            $criteria->addBaseCondition($condition);
        }
    }
}
