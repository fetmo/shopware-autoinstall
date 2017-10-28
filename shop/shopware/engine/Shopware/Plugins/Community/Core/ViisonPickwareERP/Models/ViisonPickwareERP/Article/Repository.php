<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Article;

use Shopware\Components\Model\ModelRepository;

/**
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Repository extends ModelRepository
{
    /**
     * Creates and returns a query, which fetchs extended data of all stock entities
     * and applies pagination, sorting and filters if given.
     *
     * @param int $start
     * @param int $limit
     * @param array $sort
     * @param array $filter
     * @return \Doctrine\ORM\Query
     */
    public function getAllStocksQuery($start = 0, $limit = null, array $sort = [], array $filter = [])
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select(
            'stock.id AS id',
            'stock.articleDetailId AS articleDetailId',
            'stock.warehouseId AS warehouseId',
            'stock.type AS type',
            'stock.changeAmount AS changeAmount',
            'stock.oldInstockQuantity AS oldInstockQuantity',
            'stock.newInstockQuantity AS newInstockQuantity',
            'stock.purchasePrice AS purchasePrice',
            'stock.created AS created',
            'stock.comment AS comment',
            'articleDetail.number AS articleNumber',
            'article.id AS articleId',
            'article.name AS articleName',
            'user.name AS username',
            'orderDetail.orderId AS orderId',
            'supplierOrderItem.orderId AS supplierOrderId',
            'reshipmentItem.reshipmentId AS reshipmentId'
        )->from('Shopware\CustomModels\ViisonPickwareERP\Article\Stock', 'stock')
            ->leftJoin('stock.articleDetail', 'articleDetail')
            ->leftJoin('articleDetail.article', 'article')
            ->leftJoin('stock.user', 'user')
            ->leftJoin('stock.supplierOrderItem', 'supplierOrderItem')
            ->leftJoin('stock.orderDetail', 'orderDetail')
            ->leftJoin('stock.reshipmentItem', 'reshipmentItem')
            ->addFilter($filter)
            ->addOrderBy($sort);

        // Add pagination
        if ($start !== null) {
            $builder->setFirstResult($start);
        }
        if ($limit !== null) {
            $builder->setMaxResults($limit);
        }

        return $builder->getQuery();
    }

    /**
     * Creates a query to fetch the total count of stock entities matching the given filter.
     *
     * @param array $filter
     * @return \Doctrine\ORM\Query
     */
    public function getAllStocksTotalCountQuery(array $filter = [])
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select('COUNT(stock)')
            ->from('Shopware\CustomModels\ViisonPickwareERP\Article\Stock', 'stock')
            ->addFilter($filter);

        return $builder->getQuery();
    }

    /**
     * Aggregated filtered stock entries and returns the a sorted result array
     * containing the aggregation results as well as the info about the respective article details.
     *
     * @param array $filter
     * @param array $sort
     * @return array
     */
    public function getInventory($filter = array(), $sort = array())
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select(
            'article.id AS articleId',
            'articleDetail.id AS articleDetailId',
            'articleDetail.number AS ordernumber',
            'article.name AS articlename',
            'articleDetail.additionalText AS additionalText',
            'SUM(stock.changeAmount) AS instock',
            'tax.tax AS taxrate'
        )
            ->from('Shopware\CustomModels\ViisonPickwareERP\Article\Stock', 'stock')
            ->leftJoin('stock.articleDetail', 'articleDetail')
            ->leftJoin('articleDetail.article', 'article')
            ->leftJoin('articleDetail.attribute', 'attribute')
            ->leftJoin('article.tax', 'tax')
            ->where('article.esds IS EMPTY')
            ->andWhere('attribute.viisonNotRelevantForStockManager != 1')
            ->addFilter($filter)
            ->addOrderBy($sort)
            ->groupBy('articleDetail.id');

        // Select the summed purchase price with respect to the purchase price mode
        $purchasePriceMode = Shopware()->Container()->get('plugins')->get('Core')->get('ViisonPickwareERP')->Config(
        )->get('purchasePriceMode');
        if ($purchasePriceMode === 'net') {
            $builder->addSelect('SUM(stock.changeAmount * stock.purchasePrice) AS net')
                ->addSelect('SUM((stock.changeAmount * stock.purchasePrice) * (1.0 + tax.tax / 100.0) AS gross');
        } else {
            $builder->addSelect('SUM((stock.changeAmount * stock.purchasePrice) / (1.0 + tax.tax / 100.0) AS net')
                ->addSelect('SUM(stock.changeAmount * stock.purchasePrice) AS gross');
        }

        return $builder->getQuery()->getArrayResult();
    }

    /**
     * Remove all Stock items corresponding to the given ArticleDetail-id
     *
     * @param int $articleDetailId
     */
    public function deleteByArticleDetailId($articleDetailId)
    {
        $dql = "DELETE Shopware\CustomModels\ViisonPickwareERP\Article\Stock stock
                WHERE stock.articleDetailId = :articleDetailId";

        $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('articleDetailId', $articleDetailId)
            ->execute();
    }
}
