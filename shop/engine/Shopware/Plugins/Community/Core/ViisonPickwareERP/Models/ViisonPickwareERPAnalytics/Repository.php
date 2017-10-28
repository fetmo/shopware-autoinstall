<?php
namespace Shopware\CustomModels\ViisonPickwareERPAnalytics;

use Shopware\Components\Model\DBAL;
use Shopware\Models\Analytics\Repository as AnalyticsRepository;

/**
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Repository extends AnalyticsRepository
{
    public function getMainShopCategories(\DateTime $from = null, \DateTime $to = null)
    {
        $shopRepository = Shopware()->Models()->getRepository('Shopware\Models\Shop\Shop');

        /* @var $defaultShop \Shopware\Models\Shop\Shop */
        $defaultShop = $shopRepository->getDefault();
        $categoryID = $defaultShop->getCategory()->getId();

        // We want the turnover of articles to only count for one category. To achieve this, we create a temporary helper table that only contains the first category (smallest id) of each article.
        Shopware()->Db()->query(
            'CREATE TEMPORARY TABLE s_viison_pickware_erp_tmp_min_category (
                articleID int,
                categoryID int,
                INDEX (`articleID`),
                INDEX (`categoryID`)
            )
            SELECT
                articleID,
                MIN(c.id) AS categoryID
            FROM s_articles_categories_ro ac, s_categories c
            WHERE
                c.parent=? AND
                c.id = ac.categoryID AND
                c.active=1
            GROUP BY articleID',
            [
                $categoryID
            ]
        );

        $builder = $this->createProductAmountBuilder($from, $to)
            ->addSelect('categories.description as name')
            ->addSelect('( SELECT parent FROM s_categories WHERE categories.id = parent LIMIT 1 ) as node')
            ->innerJoin('articles', 's_viison_pickware_erp_tmp_min_category', 'articleCategories', 'articles.id = articleCategories.articleID')
            ->innerJoin('articleCategories', 's_categories', 'categories', 'articleCategories.categoryID = categories.id')
            ->andWhere('categories.active = 1')
            ->groupBy('categories.id');

        $builder->andWhere('categories.parent = :parent')
            ->setParameter('parent', $categoryID);

        $builder = $this->eventManager->filter('Shopware_Plugins_ViisonPickwareERP_ViisonPickwareERPAnalyticsMainShopCategory_ProductAmountPerMainShopCategory', $builder, [
            'subject' => $this
        ]);

        return new DBAL\Result($builder);
    }
}
