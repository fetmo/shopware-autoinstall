<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier;

use Shopware\Components\Model\ModelRepository;

/**
 * Convenience functions for the supplier handling.
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Repository extends ModelRepository
{
    public function getArticleSuppliersQueryBuilder($articleDetailId, $selectable, $filterValue)
    {
        $supplierColumns = array(
            's.id',
            's.name',
            's.contact',
            's.address',
            's.email',
            's.phone',
            's.fax',
            's.comment',
            's.customernumber',
            's.deliveryTime as deliveryTime',
            's.languageId'
        );

        if ($selectable != 1) {
            $supplierColumns[] = 'asmt.articleDetailId as articleDetailId';
            $supplierColumns[] = 'asmt.defaultSupplier as isdefault';
            $supplierColumns[] = 'asmt.purchasePrice as purchasePrice';
            $supplierColumns[] = 'asmt.orderAmount as orderAmount';
        }
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select($supplierColumns)
            ->from('Shopware\CustomModels\ViisonSupplier\Supplier\ArticleDetail', 'asmt')
            ->join('asmt.supplier', 's');
        if ($articleDetailId > 0) {
            $queryBuilder
                ->where('asmt.articleDetailId = :articleDetailId')
                ->setParameter('articleDetailId', $articleDetailId);
        }

        if ($selectable == 1) {
            $queryBuilder->select('s.id');
            $selectedSupplierIds = array_map(
                function ($item) {
                    return $item['id'];
                },
                $queryBuilder->getQuery()->getArrayResult()
            );
            $queryBuilder = $this->getEntityManager()->createQueryBuilder()
                ->select($supplierColumns)
                ->from('Shopware\CustomModels\ViisonSupplier\Supplier\Supplier', 's');
            if (count($selectedSupplierIds) > 0) {
                $queryBuilder->where($queryBuilder->expr()->notIn('s.id', $selectedSupplierIds));
            }
        }
        $queryBuilder->addOrderBy('s.name', 'ASC');

        if ($filterValue != null) {
            $queryBuilder
                ->andWhere('s.name LIKE :filter OR s.contact LIKE :filter OR s.email LIKE :filter')
                ->setParameter('filter', '%' . $filterValue . '%');
        }

        return $queryBuilder;
    }

    public function getSuppliersQueryBuilder($filterValue)
    {

        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('s')
            ->from('Shopware\CustomModels\ViisonSupplier\Supplier\Supplier', 's')
            ->addOrderBy('s.name', 'ASC');

        if ($filterValue != null) {
            $queryBuilder
                ->andWhere('s.name LIKE :filter OR s.contact LIKE :filter OR s.email LIKE :filter')
                ->setParameter('filter', '%' . $filterValue . '%');
        }

        return $queryBuilder;
    }

    public function getSupplier($id)
    {
        $data = $this->getEntityManager()->createQueryBuilder()
            ->select('s')
            ->from('Shopware\CustomModels\ViisonSupplier\Supplier\Supplier', 's')
            ->where("s.id = :id")
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();

        return (count($data) == 1 ? $data[0] : null);
    }
}
