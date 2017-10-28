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

use Doctrine\DBAL\Connection;
use Shopware\Models\Article\Article;

/**
 * Backend search controller
 *
 * This controller provides the global search in the Shopware backend. The
 * search has the ability to provides search results from the different
 * areas starting from articles to orders
 */
class Shopware_Controllers_Backend_Search extends Shopware_Controllers_Backend_ExtJs
{
    /**
     * Generic search action for entities
     */
    public function searchAction()
    {
        $entity = $this->Request()->getParam('entity', null);
        $ids = $this->Request()->getParam('ids', []);
        $id = $this->Request()->getParam('id', null);
        $term = $this->Request()->getParam('query', null);
        $offset = $this->Request()->getParam('start', 0);
        $limit = $this->Request()->getParam('limit', 20);

        $builder = $this->createEntitySearchQuery($entity);

        if (!empty($ids)) {
            $ids = json_decode($ids, true);
            $this->addIdsCondition($builder, $ids);
        } elseif (!empty($id)) {
            $this->addIdsCondition($builder, [$id]);
        } else {
            if (!empty($term)) {
                $this->addSearchTermCondition($entity, $builder, $term);
            }

            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }

        $pagination = $this->getPaginator($builder);
        $data = $pagination->getIterator()->getArrayCopy();

        $data = $this->hydrateSearchResult($entity, $data);

        $this->View()->assign([
            'success' => true,
            'data' => $data,
            'total' => $pagination->count(),
        ]);
    }

    /**
     * Sanitizes the passed term and queries the different areas of the search
     *
     * @return mixed
     */
    public function indexAction()
    {
        if (!$this->Request()->isPost()) {
            return;
        }

        // Sanitize and clean up the search parameter for later processing
        $search = $this->Request()->get('search');
        $search = strtolower($search);
        $search = trim($search);

        $search = preg_replace('/[^\\w0-9]+/u', ' ', $search);
        $search = trim(preg_replace('/\s+/', '%', $search), '%');

        if ($search === '') {
            return;
        }

        $articles = $this->getArticles($search);
        $customers = $this->getCustomers($search);
        $orders = $this->getOrders($search);

        $this->View()->assign('searchResult', [
            'articles' => $articles,
            'customers' => $customers,
            'orders' => $orders,
        ]);
    }

    /**
     * Queries the articles from the database based on the passed search term
     *
     * @param $search
     *
     * @return array
     */
    public function getArticles($search)
    {
        /** @var \Doctrine\DBAL\Query\QueryBuilder $query */
        $query = $this->container->get('dbal_connection')->createQueryBuilder();

        $query->select([
            'article.id',
            'article.name',
            'article.description_long',
            'article.description',
            'variant.ordernumber',
        ]);
        $query->from('s_articles', 'article');
        $query->innerJoin('article', 's_articles_details', 'variant', 'variant.articleID = article.id');
        $query->leftJoin('article', 's_articles_translations', 'translation', 'article.id= translation.articleID');
        $query->leftJoin('article', 's_articles_supplier', 'manufacturer', 'article.supplierID = manufacturer.id');

        $builder = $this->container->get('shopware.model.search_builder');
        $builder->addSearchTerm(
            $query,
            $search,
            [
                'article.name^3',
                'variant.ordernumber^2',
                'translation.name^1',
                'manufacturer.name^1',
            ]
        );
        $query->addGroupBy('article.id');
        $query->setFirstResult(0);
        $query->setMaxResults(5);

        return $query->execute()->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Queries the customers from the database based on the passed search term
     *
     * @param $search
     *
     * @return array
     */
    public function getCustomers($search)
    {
        $search2 = Shopware()->Db()->quote("$search%");
        $search = Shopware()->Db()->quote("%$search%");

        $sql = "
            SELECT b.user_id as id,
            IF(b.company != '', b.company, CONCAT(u.firstname, ' ', u.lastname)) as name,
            CONCAT(street, ' ', zipcode, ' ', city) as description
            FROM s_user_addresses b, s_user u
            WHERE u.default_billing_address_id=b.id
            AND
            (
                email LIKE $search
                OR u.customernumber LIKE $search2
                OR TRIM(CONCAT(b.company,' ', b.department)) LIKE $search
                OR TRIM(CONCAT(b.firstname,' ',b.lastname)) LIKE $search
            )
            AND u.id = b.user_id
            GROUP BY u.id
            ORDER BY name ASC
        ";

        $sql = Shopware()->Db()->limit($sql, 5);
        $result = Shopware()->Db()->fetchAll($sql);

        return $result;
    }

    /**
     * Queries the orders from the database based on the passed search term
     *
     * @param $search
     *
     * @return array
     */
    public function getOrders($search)
    {
        $search = Shopware()->Db()->quote("$search%");

        $sql = "
            SELECT
                o.id,
                o.ordernumber as name,
                o.userID,
                o.invoice_amount as totalAmount,
                o.transactionID,
                o.status,
                o.cleared,
                d.type,
                d.docID,
                CONCAT(
                    IF(b.company != '', b.company, CONCAT(b.firstname, ' ', b.lastname)),
                    ', ',
                    p.description
                ) as description
            FROM s_order o
            LEFT JOIN s_order_documents d
            ON d.orderID=o.id AND docID != '0'
            LEFT JOIN s_order_billingaddress b
            ON o.id=b.orderID
            LEFT JOIN s_core_paymentmeans p
            ON o.paymentID = p.id
            WHERE o.id != '0'
            AND (o.ordernumber LIKE $search
            OR o.transactionID LIKE $search
            OR docID LIKE $search)
            GROUP BY o.id
            ORDER BY o.ordertime DESC
        ";
        $sql = Shopware()->Db()->limit($sql, 5);

        return Shopware()->Db()->fetchAll($sql);
    }

    /**
     * @param $builder \Doctrine\ORM\QueryBuilder
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    protected function getPaginator($builder)
    {
        $query = $builder->getQuery();
        $query->setHydrationMode(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        /** @var \Shopware\Components\Model\ModelManager $entityManager */
        $entityManager = $this->get('models');
        $pagination = $entityManager->createPaginator($query);

        return $pagination;
    }

    /**
     * @param string  $entity
     * @param array[] $data
     *
     * @return array[]
     */
    private function hydrateSearchResult($entity, $data)
    {
        $data = array_map(function ($row) {
            if (array_key_exists('_score', $row) && array_key_exists(0, $row)) {
                return $row[0];
            }

            return $row;
        }, $data);

        switch ($entity) {
            case 'Shopware\Models\Category\Category':
                $data = $this->resolveCategoryPath($data);
                break;
        }

        return $data;
    }

    /**
     * @param string $entity
     *
     * @return string[]
     */
    private function getEntitySearchFields($entity)
    {
        /** @var \Shopware\Components\Model\ModelManager $entityManager */
        $entityManager = $this->get('models');
        $metaData = $entityManager->getClassMetadata($entity);

        $fields = array_filter(
            $metaData->getFieldNames(),
            function ($field) use ($metaData) {
                $type = $metaData->getTypeOfField($field);

                return in_array($type, ['string', 'text', 'date', 'datetime', 'decimal', 'float']);
            }
        );

        if (empty($fields)) {
            return $metaData->getFieldNames();
        }

        return $fields;
    }

    /**
     * @param $entity
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createEntitySearchQuery($entity)
    {
        /** @var \Doctrine\ORM\QueryBuilder $query */
        $query = $this->get('models')->createQueryBuilder();
        $query->select('entity')
            ->from($entity, 'entity');

        switch ($entity) {
            case 'Shopware\Models\Article\Article':
                $query->select(['entity.id', 'entity.name', 'mainDetail.number'])
                    ->innerJoin('entity.mainDetail', 'mainDetail')
                    ->leftJoin('entity.details', 'details');
                break;

            case 'Shopware\Models\Property\Value':
                if ($groupId = $this->Request()->getParam('groupId')) {
                    $query->andWhere('entity.optionId = :optionId')
                        ->setParameter(':optionId', $this->Request()->getParam('groupId'));
                }
                break;

            case 'Shopware\Models\Property\Option':
                if ($setId = $this->Request()->getParam('setId')) {
                    $query->innerJoin('entity.relations', 'relations', 'WITH', 'relations.groupId = :setId')
                        ->setParameter(':setId', $setId);
                }
                break;
            case 'Shopware\Models\Category\Category':
                $query->andWhere('entity.parent IS NOT NULL')
                    ->addOrderBy('entity.parentId')
                    ->addOrderBy('entity.position');
                break;
        }

        return $query;
    }

    /**
     * @param string                     $entity
     * @param \Doctrine\ORM\QueryBuilder $query
     * @param string                     $term
     */
    private function addSearchTermCondition($entity, $query, $term)
    {
        $fields = $this->getEntitySearchFields($entity);

        $builder = Shopware()->Container()->get('shopware.model.search_builder');

        $fields = array_map(function ($field) {
            return 'entity.' . $field;
        }, $fields);

        switch ($entity) {
            case Article::class:
                $fields[] = 'mainDetail.number';
                break;
        }

        $builder->addSearchTerm($query, $term, $fields);
    }

    /**
     * Creates a custom search term condition
     *
     * @param string $entity
     * @param string $column
     *
     * @return string
     */
    private function createCustomFieldToSearchTermCondition($entity, $column)
    {
        $field = $entity . '.' . $column;
        $where = $field . ' LIKE :search';

        return $where;
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $query
     * @param int[]                      $ids
     */
    private function addIdsCondition($query, $ids)
    {
        $query->andWhere('entity.id IN (:ids)')
            ->setParameter('ids', $ids, Connection::PARAM_INT_ARRAY);
    }

    /**
     * @param $data
     *
     * @return array[]
     */
    private function resolveCategoryPath($data)
    {
        $ids = [];
        foreach ($data as $row) {
            $ids = array_merge($ids, explode('|', $row['path']));
            $ids[] = $row['id'];
        }
        $ids = array_values(array_unique(array_filter($ids)));
        $categories = $this->getCategories($ids);

        foreach ($data as &$row) {
            $parents = array_filter(explode('|', $row['path']));
            $parents = array_reverse($parents);
            $path = [];
            foreach ($parents as $parent) {
                $path[] = $categories[$parent];
            }
            $path[] = $row['name'];
            $row['name'] = implode('>', $path);
        }

        return $data;
    }

    /**
     * @param $ids
     */
    private function getCategories($ids)
    {
        /** @var \Doctrine\DBAL\Query\QueryBuilder $query */
        $query = $this->get('dbal_connection')->createQueryBuilder();
        $query->select(['id', 'description'])
            ->from('s_categories', 'category')
            ->where('category.id IN (:ids)')
            ->setParameter(':ids', $ids, Connection::PARAM_INT_ARRAY);

        return $query->execute()->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
