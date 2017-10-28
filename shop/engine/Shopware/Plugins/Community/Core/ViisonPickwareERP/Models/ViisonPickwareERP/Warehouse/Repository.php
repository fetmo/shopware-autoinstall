<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\ORM\AbstractQuery;
use Shopware\Components\Model\ModelRepository;
use Shopware\Models\Article\Detail as ArticleDetail;

/**
 * Convenience functions for the Warehouse and BinLocation handling.
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Repository extends ModelRepository
{
    /**
     * Finds and returns the default warehouse.
     *
     * @return Warehouse
     */
    public function getDefaultWarehouse()
    {
        return $this->findOneBy([
            'defaultWarehouse' => true
        ]);
    }

    /**
     * Tries to find a dedicated bin location for the given $articleDetail in the given $warehouse
     * and returns it. If no such bin location can be found, the warehouse's default bin location
     * is returned instead.
     *
     * @param Warehouse $warehouse
     * @param ArticleDetail $articleDetail
     * @return BinLocation
     */
    public function findBinLocation(Warehouse $warehouse, ArticleDetail $articleDetail)
    {
        // Try to find a bin location mapping
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder
            ->select(
                'articleMapping',
                'binLocation'
            )
            ->from(BinLocationArticleDetail::class, 'articleMapping')
            ->join('articleMapping.binLocation', 'binLocation')
            ->where('articleMapping.articleDetail = :articleDetail')
            ->andWhere('binLocation.warehouse = :warehouse')
            ->setMaxResults(1)
            ->setParameters([
                'articleDetail' => $articleDetail,
                'warehouse' => $warehouse
            ]);
        $binLocationMapping = $builder->getQuery()->getOneOrNullResult();

        return ($binLocationMapping) ? $binLocationMapping->getBinLocation() : $warehouse->getDefaultBinLocation();
    }

    /**
     * Finds and returns all BinLocationArticleDetail entities that belong to the article detail
     * with the given ID.
     *
     * @param int $articleDetailId
     * @param string $hydrationMode
     * @return array
     */
    public function findBinLocationMappingsForArticleDetailId($articleDetailId, $hydrationMode = AbstractQuery::HYDRATE_OBJECT)
    {
        // Create query and pre-fetch BinLocation as well as Warehouse
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder
            ->select(
                'articleMapping',
                'binLocation'
            )
            ->from(BinLocationArticleDetail::class, 'articleMapping')
            ->join('articleMapping.binLocation', 'binLocation')
            ->where('articleMapping.articleDetailId = :articleDetailId')
            ->setParameter('articleDetailId', $articleDetailId);

        return $builder->getQuery()->getResult($hydrationMode);
    }


    /**
     * Fetches and returns the BinLocationArticleDetail for a particular ArticleDetail in a particular BinLocation.
     *
     * @param BinLocation $binLocation
     * @param ArticleDetail $articleDetail
     * @param string $hydrationMode
     * @return BinLocationArticleDetail|null the BinLocationArticle for the ArticleDetail in the BinLocation,
     *         null if the ArticleDetail does not exist in the BinLocation
     */
    public function findBinLocationArticleDetail(
        ArticleDetail $articleDetail,
        BinLocation $binLocation,
        $hydrationMode = AbstractQuery::HYDRATE_OBJECT
    ) {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder
            ->select('binLocationArticleDetail')
            ->from(BinLocationArticleDetail::class, 'binLocationArticleDetail')
            ->where('binLocationArticleDetail.articleDetail = :articleDetail')
            ->andWhere('binLocationArticleDetail.binLocation = :binLocation')
            ->setMaxResults(1)
            ->setParameters([
                'articleDetail' => $articleDetail,
                'binLocation' => $binLocation
            ]);

        return $builder->getQuery()->getOneOrNullResult($hydrationMode);
    }

    /**
     * Fetches and returns the warehouse Stock for a particular ArticleDetail in a particular Warehouse.
     *
     * @param Warehouse $warehouse
     * @param ArticleDetail $articleDetail
     * @return Stock|null
     */
    public function findWarehouseStock(Warehouse $warehouse, ArticleDetail $articleDetail)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder
            ->select('warehouseStock')
            ->from(Stock::class, 'warehouseStock')
            ->where('warehouseStock.warehouse = :warehouse')
            ->andWhere('warehouseStock.articleDetail = :articleDetail')
            ->setMaxResults(1)
            ->setParameters([
                'articleDetail' => $articleDetail,
                'warehouse' => $warehouse
            ]);

        return $builder->getQuery()->getOneOrNullResult();
    }
}
