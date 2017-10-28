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

use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\FacetResultInterface;
use Shopware\Bundle\SearchBundle\ProductNumberSearchResult;
use Shopware\Bundle\SearchBundle\StoreFrontCriteriaFactoryInterface;
use Shopware\Bundle\StoreFrontBundle\Service\CustomFacetServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\Product\Manufacturer;
use Shopware\Bundle\StoreFrontBundle\Struct\ProductContextInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\Search\CustomFacet;
use Shopware\Bundle\StoreFrontBundle\Struct\Search\CustomSorting;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

/**
 * Listing controller
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Shopware_Controllers_Frontend_Listing extends Enlight_Controller_Action
{
    /**
     * Index action method
     *
     * @throws \Enlight_Controller_Exception
     */
    public function indexAction()
    {
        $requestCategoryId = $this->Request()->getParam('sCategory');

        $categoryContent = $this->loadCategoryContent($requestCategoryId);

        $emotionConfiguration = $this->getEmotionConfiguration($requestCategoryId, false);

        $location = $this->getRedirectLocation($categoryContent, $emotionConfiguration['hasEmotion']);
        if ($location) {
            $this->redirect($location, ['code' => 301]);

            return;
        }

        $hasCustomerStreamEmotions = $this->container->get('shopware.customer_stream.repository')
            ->hasCustomerStreamEmotions($requestCategoryId);

        if ($hasCustomerStreamEmotions && !$this->Request()->getParam('sPage')) {
            $assign = $this->View()->getAssign();
            $this->View()->loadTemplate('frontend/listing/customer_stream.tpl');
            $this->View()->assign($assign);

            return;
        }

        $this->View()->assign($emotionConfiguration);

        // only show the listing if an emotion viewport is empty or the showListing option is active
        if (!$emotionConfiguration['showListing']) {
            return;
        }

        $this->loadCategoryListing($requestCategoryId, $categoryContent);
    }

    public function layoutAction()
    {
        $this->View()->loadTemplate('frontend/listing/customer_stream/layout.tpl');

        $categoryId = (int) $this->Request()->getParam('sCategory');

        $config = $this->getEmotionConfiguration($categoryId, true);

        $categoryContent = Shopware()->Modules()->Categories()->sGetCategoryContent($categoryId);

        $config = array_merge($config, [
            'sBanner' => Shopware()->Modules()->Marketing()->sBanner($categoryId),
            'sCategoryContent' => $categoryContent,
            'Controller' => 'listing',
            'params' => $this->Request()->getParams(),
        ]);

        $this->View()->assign($config);
    }

    public function listingAction()
    {
        $this->View()->loadTemplate('frontend/listing/customer_stream/listing.tpl');

        $requestCategoryId = $this->Request()->getParam('sCategory');

        $categoryContent = $this->loadCategoryContent($requestCategoryId);

        $this->loadCategoryListing($requestCategoryId, $categoryContent);
    }

    /**
     * Listing of all manufacturer products.
     * Templates extends from the normal listing template.
     *
     * @throws \Enlight_Exception
     */
    public function manufacturerAction()
    {
        $manufacturerId = $this->Request()->getParam('sSupplier', null);

        /** @var $context ProductContextInterface */
        $context = $this->get('shopware_storefront.context_service')->getShopContext();

        /** @var \Shopware\Bundle\StoreFrontBundle\Service\CustomSortingServiceInterface $service */
        $sortingService = $this->get('shopware_storefront.custom_sorting_service');

        if (!$this->Request()->getParam('sCategory')) {
            $categoryId = $context->getShop()->getCategory()->getId();

            $this->Request()->setParam('sCategory', $categoryId);

            $sortings = $sortingService->getSortingsOfCategories([$categoryId], $context);

            /** @var CustomSorting[] $sortings */
            $sortings = array_shift($sortings);

            $this->setDefaultSorting($sortings);
        }

        /** @var $criteria Criteria */
        $criteria = $this->get('shopware_search.store_front_criteria_factory')
            ->createListingCriteria($this->Request(), $context);

        if ($criteria->hasCondition('manufacturer')) {
            $condition = $criteria->getCondition('manufacturer');
            $criteria->removeCondition('manufacturer');
            $criteria->addBaseCondition($condition);
        }

        $categoryArticles = Shopware()->Modules()->Articles()->sGetArticlesByCategory(
            $context->getShop()->getCategory()->getId(),
            $criteria
        );

        /** @var $manufacturer Manufacturer */
        $manufacturer = $this->get('shopware_storefront.manufacturer_service')->get(
            $manufacturerId,
            $this->get('shopware_storefront.context_service')->getShopContext()
        );

        if ($manufacturer === null) {
            throw new Enlight_Controller_Exception(
                'Manufacturer missing, non-existent or invalid',
                404
            );
        }

        $facets = [];
        foreach ($categoryArticles['facets'] as $facet) {
            if (!$facet instanceof FacetResultInterface || $facet->getFacetName() === 'manufacturer') {
                continue;
            }
            $facets[] = $facet;
        }

        $categoryArticles['facets'] = $facets;

        $this->View()->assign($categoryArticles);
        $this->View()->assign('showListing', true);
        $this->View()->assign('manufacturer', $manufacturer);
        $this->View()->assign('ajaxCountUrlParams', [
            'sSupplier' => $manufacturerId,
            'sCategory' => $context->getShop()->getCategory()->getId(),
        ]);

        $this->View()->assign('sCategoryContent', $this->getSeoDataOfManufacturer($manufacturer));
    }

    /**
     * Returns listing breadcrumb
     *
     * @param int $categoryId
     *
     * @return array
     */
    public function getBreadcrumb($categoryId)
    {
        $breadcrumb = Shopware()->Modules()->Categories()->sGetCategoriesByParent($categoryId);

        return array_reverse($breadcrumb);
    }

    /**
     * @param int  $categoryId
     * @param bool $withStreams
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function getEmotionConfiguration($categoryId, $withStreams = false)
    {
        if ($this->Request()->getParam('sPage')) {
            return [
                'hasEmotion' => false,
                'showListing' => true,
                'showListingDevices' => [],
            ];
        }
        $context = $this->container->get('shopware_storefront.context_service')->getShopContext();

        $service = $this->container->get('shopware_emotion.store_front_emotion_device_configuration');

        $emotions = $service->getCategoryConfiguration($categoryId, $context, $withStreams);

        $isHomePage = $context->getShop()->getCategory()->getId() === $categoryId;

        $devicesWithListing = $this->getDevicesWithListing($emotions);
        if ($isHomePage) {
            $devicesWithListing = [];
        }

        return [
            'emotions' => $emotions,
            'hasEmotion' => !empty($emotions),
            'showListing' => $this->hasListing($emotions) && !$isHomePage,
            'showListingDevices' => $devicesWithListing,
            'isHomePage' => $isHomePage,
        ];
    }

    /**
     * @param array $categoryContent
     * @param bool $hasEmotion
     *
     * @return array|bool
     * @throws \Enlight_Controller_Exception
     */
    private function getRedirectLocation($categoryContent, $hasEmotion)
    {
        $location = false;

        $checkRedirect = (
            ($hasEmotion && $this->Request()->getParam('sPage'))
            ||
            (!$hasEmotion)
        );

        if (!empty($categoryContent['external'])) {
            $location = $categoryContent['external'];
        } elseif (empty($categoryContent)) {
            throw new \Enlight_Controller_Exception(
                'Category not found',
                Enlight_Controller_Exception::Controller_Dispatcher_Controller_Not_Found
            );
        } elseif ($this->isShopsBaseCategoryPage($categoryContent['id'])) {
            $location = ['controller' => 'index'];
        } elseif ($checkRedirect && $this->get('config')->get('categoryDetailLink')) {
            /** @var $context ShopContextInterface */
            $context = $this->get('shopware_storefront.context_service')->getShopContext();

            /** @var $factory StoreFrontCriteriaFactoryInterface */
            $factory = $this->get('shopware_search.store_front_criteria_factory');
            $criteria = $factory->createListingCriteria($this->Request(), $context);

            $criteria->resetFacets()
                ->resetConditions()
                ->resetSorting()
                ->offset(0)
                ->limit(2)
                ->setFetchCount(false);

            /** @var $result ProductNumberSearchResult */
            $result = $this->get('shopware_search.product_number_search')->search($criteria, $context);

            if (count($result->getProducts()) === 1) {
                /** @var $first \Shopware\Bundle\StoreFrontBundle\Struct\BaseProduct */
                $first = array_shift($result->getProducts());
                $location = ['controller' => 'detail', 'sArticle' => $first->getId()];
            }
        }

        return $location;
    }

    /**
     * Converts the provided manufacturer to the category seo data structure.
     * Result can be merged with "sCategoryContent" to override relevant seo category data with
     * manufacturer data.
     *
     * @param Manufacturer $manufacturer
     *
     * @return array
     */
    private function getSeoDataOfManufacturer(Manufacturer $manufacturer)
    {
        $content = [];

        $content['metaDescription'] = $manufacturer->getMetaDescription();
        $content['metaKeywords'] = $manufacturer->getMetaKeywords();

        $canonicalParams = [
            'sViewport' => 'listing',
            'sAction' => 'manufacturer',
            'sSupplier' => $manufacturer->getId(),
        ];

        $content['canonicalParams'] = $canonicalParams;

        $path = $this->Front()->Router()->assemble($canonicalParams);

        if ($path) {
            /* @deprecated */
            $content['sSelfCanonical'] = $path;
        }

        $content['metaTitle'] = $manufacturer->getMetaTitle();
        $content['title'] = $manufacturer->getName();

        return $content;
    }

    /**
     * Checks if the provided $categoryId is in the current shop's category tree
     *
     * @param int $categoryId
     *
     * @return bool
     */
    private function isValidCategoryPath($categoryId)
    {
        $defaultShopCategoryId = Shopware()->Shop()->getCategory()->getId();

        /** @var $repository \Shopware\Models\Category\Repository */
        $categoryRepository = Shopware()->Models()->getRepository('Shopware\Models\Category\Category');
        $categoryPath = $categoryRepository->getPathById($categoryId);

        if (!array_key_exists($defaultShopCategoryId, $categoryPath)) {
            $this->Request()->setQuery('sCategory', $defaultShopCategoryId);
            $this->Response()->setHttpResponseCode(404);

            return false;
        }

        return true;
    }

    /**
     * Helper function used in the listing action to detect if
     * the user is trying to open the page matching the shop's root category
     *
     * @param int $categoryId
     *
     * @return bool
     */
    private function isShopsBaseCategoryPage($categoryId)
    {
        $defaultShopCategoryId = Shopware()->Shop()->getCategory()->getId();

        $queryParamsWhiteList = ['controller', 'action', 'sCategory', 'sViewport', 'rewriteUrl', 'module'];
        $queryParamsNames = array_keys($this->Request()->getParams());
        $paramsDiff = array_diff($queryParamsNames, $queryParamsWhiteList);

        return $defaultShopCategoryId === (int) $categoryId && !$paramsDiff;
    }

    /**
     * Determines if the product listing has to be loaded/shown at all
     *
     * @param array $emotions
     *
     * @return bool
     */
    private function hasListing(array $emotions)
    {
        if (empty($emotions)) {
            return true;
        }

        $showListing = (bool) max(array_column($emotions, 'showListing'));
        if ($showListing) {
            return true;
        }

        $devices = $this->getDevicesWithListing($emotions);

        return !empty($devices);
    }

    /**
     * Filters the device types down to which have to show the product listing
     *
     * @param array $emotions
     *
     * @return int[]
     */
    private function getDevicesWithListing(array $emotions)
    {
        $visibleDevices = [0, 1, 2, 3, 4];
        $permanentVisibleDevices = [];

        foreach ($emotions as $emotion) {
            // always show the listing in the emotion viewports when the option "show listing" is active
            if ($emotion['showListing']) {
                $permanentVisibleDevices = array_merge($permanentVisibleDevices, $emotion['devicesArray']);
            }

            $visibleDevices = array_diff($visibleDevices, $emotion['devicesArray']);
        }

        $visibleDevices = array_merge($permanentVisibleDevices, $visibleDevices);

        return array_values($visibleDevices);
    }

    /**
     * @param CustomSorting[] $sortings
     */
    private function setDefaultSorting($sortings)
    {
        if ($this->Request()->has('sSort')) {
            return;
        }

        /** @var CustomSorting $default */
        $default = array_shift($sortings);

        if (!$default) {
            return;
        }

        $this->Request()->setParam('sSort', $default->getId());
    }

    /**
     * @param int $categoryId
     * @param int $streamId
     *
     * @return Criteria
     */
    private function createCategoryStreamCriteria($categoryId, $streamId)
    {
        /** @var \Shopware\Bundle\StoreFrontBundle\Service\ContextServiceInterface $contextService */
        $contextService = $this->get('shopware_storefront.context_service');
        $context = $contextService->getShopContext();

        /** @var \Shopware\Components\ProductStream\CriteriaFactoryInterface $factory */
        $factory = $this->get('shopware_product_stream.criteria_factory');
        $criteria = $factory->createCriteria($this->Request(), $context);

        /** @var \Shopware\Components\ProductStream\RepositoryInterface $streamRepository */
        $streamRepository = $this->get('shopware_product_stream.repository');
        $streamRepository->prepareCriteria($criteria, $streamId);

        /** @var CustomFacetServiceInterface $facetService */
        $facetService = $this->get('shopware_storefront.custom_facet_service');
        $facets = $facetService->getFacetsOfCategories([$categoryId], $context);

        /** @var CustomFacet[] $facets */
        $facets = array_shift($facets);
        foreach ($facets as $facet) {
            $criteria->addFacet($facet->getFacet());
        }

        /** @var \Shopware\Components\ProductStream\FacetFilter $facetFilter */
        $facetFilter = $this->get('shopware_product_stream.facet_filter');
        $facetFilter->add($criteria);

        return $criteria;
    }

    /**
     * @param int   $categoryId
     * @param array $categoryContent
     *
     * @throws \Enlight_Exception
     */
    private function loadCategoryListing($categoryId, array $categoryContent)
    {
        $context = $this->get('shopware_storefront.context_service')->getShopContext();

        /** @var \Shopware\Bundle\StoreFrontBundle\Service\CustomSortingServiceInterface $service */
        $service = $this->get('shopware_storefront.custom_sorting_service');

        $sortings = $service->getSortingsOfCategories([$categoryId], $context);

        /** @var CustomSorting[] $sortings */
        $sortings = array_shift($sortings);

        $this->setDefaultSorting($sortings);

        if ($categoryContent['streamId']) {
            $criteria = $this->createCategoryStreamCriteria($categoryId, $categoryContent['streamId']);
        } else {
            /** @var $criteria Criteria */
            $criteria = $this->get('shopware_search.store_front_criteria_factory')
                ->createListingCriteria($this->Request(), $context);
        }

        if ($categoryContent['hideFilter']) {
            $criteria->resetFacets();
        }

        $categoryArticles = Shopware()->Modules()->Articles()->sGetArticlesByCategory($categoryId, $criteria);
        $viewData = $this->View()->getAssign();

        if ($this->Request()->getParam('sRss') || $this->Request()->getParam('sAtom')) {
            $this->Response()->setHeader('Content-Type', 'text/xml');
            $type = $this->Request()->getParam('sRss') ? 'rss' : 'atom';
            $this->View()->loadTemplate('frontend/listing/' . $type . '.tpl');
        } elseif (!empty($categoryContent['template'])) {
            if ($this->View()->templateExists('frontend/listing/' . $categoryContent['template'])) {
                $this->View()->loadTemplate('frontend/listing/' . $categoryContent['template']);
            } else {
                $this->get('corelogger')->error(
                    'Missing category template detected. Please correct the template for category "' . $categoryContent['name'] . '".',
                    [
                        'uri' => $this->Request()->getRequestUri(),
                        'categoryId' => $categoryId,
                        'categoryName' => $categoryContent['name'],
                    ]
                );
            }
        }

        $this->View()->assign($viewData);

        /** @var \Shopware\Components\ProductStream\FacetFilter $facetFilter */
        $facetFilter = $this->get('shopware_product_stream.facet_filter');
        $facets = $facetFilter->filter($categoryArticles['facets'], $criteria);
        $categoryArticles['facets'] = $facets;

        $this->View()->assign($categoryArticles);
        $this->View()->assign('sortings', $sortings);
    }

    /**
     * @param int $requestCategoryId
     *
     * @throws Enlight_Controller_Exception
     *
     * @return array
     */
    private function loadCategoryContent($requestCategoryId)
    {
        if ($requestCategoryId && !$this->isValidCategoryPath($requestCategoryId)) {
            throw new Enlight_Controller_Exception(
                'Listing category missing, non-existent or invalid for the current shop',
                404
            );
        }

        $categoryContent = Shopware()->Modules()->Categories()->sGetCategoryContent($requestCategoryId);
        Shopware()->System()->_GET['sCategory'] = $requestCategoryId;

        $this->View()->assign([
            'sBanner' => Shopware()->Modules()->Marketing()->sBanner($requestCategoryId),
            'sBreadcrumb' => $this->getBreadcrumb($requestCategoryId),
            'sCategoryContent' => $categoryContent,
            'activeFilterGroup' => $this->request->getQuery('sFilterGroup'),
            'ajaxCountUrlParams' => ['sCategory' => $categoryContent['id']],
            'params' => $this->Request()->getParams(),
        ]);

        return $categoryContent;
    }
}
