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

use Shopware\Components\Random;

/**
 * Shopware Frontend Controller for the Blog
 *
 * Frontend Controller for the blog article listing and the detail page.
 * Contains the logic for the listing of the blog articles and the detail page.
 * Furthermore it will manage the blog comment handling
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Shopware_Controllers_Frontend_Blog extends Enlight_Controller_Action
{
    /**
     * @var \Shopware\Models\Blog\Repository
     */
    protected $repository;

    /**
     * @var \Shopware\Models\Category\Repository
     */
    protected $blogCommentRepository;

    /**
     * @var \Shopware\Models\Category\Repository
     */
    protected $categoryRepository;

    /**
     * @var \Shopware\Models\CommentConfirm\Repository
     */
    protected $commentConfirmRepository;

    /**
     * @var string
     */
    protected $blogBaseUrl;

    /**
     * Init controller method
     */
    public function init()
    {
        $this->blogBaseUrl = Shopware()->Config()->get('baseFile');
    }

    /**
     * Pre dispatch method
     */
    public function preDispatch()
    {
        $this->View()->setScope(Enlight_Template_Manager::SCOPE_PARENT);
    }

    /**
     * Helper Method to get access to the blog repository.
     *
     * @return Shopware\Models\Blog\Repository
     */
    public function getRepository()
    {
        if ($this->repository === null) {
            $this->repository = Shopware()->Models()->getRepository('Shopware\Models\Blog\Blog');
        }

        return $this->repository;
    }

    /**
     * Helper Method to get access to the blog comment repository.
     *
     * @return Shopware\Models\Blog\Repository
     */
    public function getBlogCommentRepository()
    {
        if ($this->blogCommentRepository === null) {
            $this->blogCommentRepository = Shopware()->Models()->getRepository(Shopware\Models\Blog\Comment::class);
        }

        return $this->blogCommentRepository;
    }

    /**
     * Helper Method to get access to the category repository.
     *
     * @return Shopware\Models\Category\Repository
     */
    public function getCategoryRepository()
    {
        if ($this->categoryRepository === null) {
            $this->categoryRepository = Shopware()->Models()->getRepository(Shopware\Models\Category\Category::class);
        }

        return $this->categoryRepository;
    }

    /**
     * Helper Method to get access to the commentConfirm repository.
     *
     * @return Shopware\Models\CommentConfirm\Repository
     */
    public function getCommentConfirmRepository()
    {
        if ($this->commentConfirmRepository === null) {
            $this->commentConfirmRepository = Shopware()->Models()->getRepository(Shopware\Models\CommentConfirm\CommentConfirm::class);
        }

        return $this->commentConfirmRepository;
    }

    /**
     * Index action method
     */
    public function indexAction()
    {
        $categoryId = (int) $this->Request()->getQuery('sCategory');
        $page = (int) $this->request->getParam('sPage', 1);
        $page = $page >= 1 ? $page : 1;
        $filterDate = urldecode($this->Request()->sFilterDate);
        $filterAuthor = urldecode($this->Request()->sFilterAuthor);
        $filterTags = urldecode($this->Request()->sFilterTags);

        // Redirect if blog's category is not a child of the current shop's category
        $shopCategory = Shopware()->Shop()->getCategory();
        $category = $this->getCategoryRepository()->findOneBy(['id' => $categoryId, 'active' => true]);
        $isChild = ($shopCategory && $category) ? $category->isChildOf($shopCategory) : false;
        if (!$isChild) {
            return $this->redirect(['controller' => 'index'], ['code' => 301]);
        }

        // PerPage
        if (!empty($this->Request()->sPerPage)) {
            Shopware()->Session()->sPerPage = (int) $this->Request()->sPerPage;
        }
        $perPage = (int) Shopware()->Session()->sPerPage;
        if (empty($perPage)) {
            $perPage = (int) Shopware()->Config()->get('sARTICLESPERPAGE');
        }

        $filter = $this->createFilter($filterDate, $filterAuthor, $filterTags);

        // Start for Limit
        $limitStart = ($page - 1) * $perPage;
        $limitEnd = $perPage;

        //get all blog articles
        $query = $this->getCategoryRepository()->getBlogCategoriesByParentQuery($categoryId);
        $blogCategories = $query->getArrayResult();
        $blogCategoryIds = $this->getBlogCategoryListIds($blogCategories);
        $blogCategoryIds[] = $categoryId;
        $blogArticlesQuery = $this->getRepository()->getListQuery($blogCategoryIds, $limitStart, $limitEnd, $filter);
        $blogArticlesQuery->setHydrationMode(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $paginator = Shopware()->Models()->createPaginator($blogArticlesQuery);

        //returns the total count of the query
        $totalResult = $paginator->count();

        //returns the blog article data
        $blogArticles = $paginator->getIterator()->getArrayCopy();

        $mediaIds = array_map(function ($blogArticle) {
            if (isset($blogArticle['media']) && $blogArticle['media'][0]['mediaId']) {
                return $blogArticle['media'][0]['mediaId'];
            }
        }, $blogArticles);

        $context = $this->get('shopware_storefront.context_service')->getShopContext();
        $medias = $this->get('shopware_storefront.media_service')->getList($mediaIds, $context);

        foreach ($blogArticles as $key => $blogArticle) {
            //adding number of comments to the blog article
            $blogArticles[$key]['numberOfComments'] = count($blogArticle['comments']);

            //adding tags and tag filter links to the blog article
            $tagsQuery = $this->repository->getTagsByBlogId($blogArticle['id']);
            $tagsData = $tagsQuery->getArrayResult();
            $blogArticles[$key]['tags'] = $this->addLinksToFilter($tagsData, 'sFilterTags', 'name', false);

            //adding average vote data to the blog article
            $avgVoteQuery = $this->repository->getAverageVoteQuery($blogArticle['id']);
            $blogArticles[$key]['sVoteAverage'] = $avgVoteQuery->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SINGLE_SCALAR);

            //adding thumbnails to the blog article
            if (empty($blogArticle['media'][0]['mediaId'])) {
                continue;
            }

            $mediaId = $blogArticle['media'][0]['mediaId'];

            if (!isset($medias[$mediaId])) {
                continue;
            }

            /** @var $media \Shopware\Bundle\StoreFrontBundle\Struct\Media */
            $media = $medias[$mediaId];
            $media = $this->get('legacy_struct_converter')->convertMediaStruct($media);

            $blogArticles[$key]['media'] = $media;
        }

        //RSS and ATOM Feed part
        if ($this->Request()->getParam('sRss') || $this->Request()->getParam('sAtom')) {
            $this->Response()->setHeader('Content-Type', 'text/xml');
            $type = $this->Request()->getParam('sRss') ? 'rss' : 'atom';
            $this->View()->loadTemplate('frontend/blog/' . $type . '.tpl');
        }

        $categoryContent = Shopware()->Modules()->Categories()->sGetCategoryContent($categoryId);
        $assigningData = [
            'sBanner' => Shopware()->Modules()->Marketing()->sBanner($categoryId),
            'sBreadcrumb' => $this->getCategoryBreadcrumb($categoryId),
            'sCategoryContent' => $categoryContent,
            'sNumberArticles' => $totalResult,
            'sPage' => $page,
            'sPerPage' => $perPage,
            'sFilterDate' => $this->getDateFilterData($blogCategoryIds, $filter),
            'sFilterAuthor' => $this->getAuthorFilterData($blogCategoryIds, $filter),
            'sFilterTags' => $this->getTagsFilterData($blogCategoryIds, $filter),
            'sCategoryInfo' => $categoryContent,
            'sBlogArticles' => $blogArticles,
        ];

        $filters = [
            'sFilterDate' => urlencode($filterDate),
            'sFilterAuthor' => urlencode($filterAuthor),
            'sFilterTags' => urlencode($filterTags),
        ];

        $this->View()->assign(array_merge($assigningData, $this->getPagerData($totalResult, $limitEnd, $page, $categoryId, $filters)));
    }

    /**
     * Detail action method
     *
     * Contains the logic for the detail page of a blog article
     */
    public function detailAction()
    {
        $blogArticleId = (int) $this->Request()->getQuery('blogArticle');
        if (empty($blogArticleId)) {
            $this->forward('index', 'index');

            return;
        }

        $blogArticleQuery = $this->getRepository()->getDetailQuery($blogArticleId);
        $blogArticleData = $blogArticleQuery->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        //redirect if the blog item is not available
        if (empty($blogArticleData) || empty($blogArticleData['active'])) {
            return $this->redirect(['controller' => 'index'], ['code' => 301]);
        }

        // Redirect if category is not available, inactive or external
        /** @var $category \Shopware\Models\Category\Category */
        $category = $this->getCategoryRepository()->find($blogArticleData['categoryId']);
        if ($category === null || !$category->getActive()) {
            $location = ['controller' => 'index'];
        }

        // Redirect if blog's category is not a child of the current shop's category
        $shopCategory = Shopware()->Shop()->getCategory();
        $isChild = ($shopCategory && $category) ? $category->isChildOf($shopCategory) : false;
        if (!$isChild) {
            $location = ['controller' => 'index'];
        }

        if (isset($location)) {
            return $this->redirect($location, ['code' => 301]);
        }

        //load the right template
        if (!empty($blogArticleData['template'])) {
            $this->View()->loadTemplate('frontend/blog/' . $blogArticleData['template']);
        }

        $this->View()->userLoggedIn = !empty(Shopware()->Session()->sUserId);
        if (!empty(Shopware()->Session()->sUserId) && empty($this->Request()->name)
                && $this->Request()->getParam('__cache') === null) {
            $userData = Shopware()->Modules()->Admin()->sGetUserData();
            $this->View()->sFormData = [
                'eMail' => $userData['additional']['user']['email'],
                'name' => $userData['billingaddress']['firstname'] . ' ' . $userData['billingaddress']['lastname'],
            ];
        }

        $mediaIds = array_column($blogArticleData['media'], 'mediaId');
        $context = $this->get('shopware_storefront.context_service')->getShopContext();
        $mediaStructs = $this->get('shopware_storefront.media_service')->getList($mediaIds, $context);
        $mediaService = Shopware()->Container()->get('shopware_media.media_service');

        //adding thumbnails to the blog article
        foreach ($blogArticleData['media'] as &$media) {
            $mediaId = $media['mediaId'];
            $mediaData = $this->get('legacy_struct_converter')->convertMediaStruct($mediaStructs[$mediaId]);
            if ($media['preview']) {
                $blogArticleData['preview'] = $mediaData;
            }
            $media = array_merge($media, $mediaData);
        }

        //add sRelatedArticles
        foreach ($blogArticleData['assignedArticles'] as &$assignedArticle) {
            $product = Shopware()->Modules()->Articles()->sGetPromotionById('fix', 0, (int) $assignedArticle['id']);
            if ($product) {
                $blogArticleData['sRelatedArticles'][] = $product;
            }
        }

        //adding average vote data to the blog article
        $avgVoteQuery = $this->repository->getAverageVoteQuery($blogArticleId);
        $blogArticleData['sVoteAverage'] = $avgVoteQuery->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_SINGLE_SCALAR);

        //count the views of this blog item
        $visitedBlogItems = Shopware()->Session()->visitedBlogItems;
        if (!Shopware()->Session()->Bot && !in_array($blogArticleId, $visitedBlogItems)) {
            //update the views count
            /* @var $blogModel Shopware\Models\Blog\Blog */
            $blogModel = $this->getRepository()->find($blogArticleId);
            if ($blogModel) {
                $blogModel->setViews($blogModel->getViews() + 1);
                Shopware()->Models()->flush($blogModel);

                //save it to the session
                $visitedBlogItems[] = $blogArticleId;
                Shopware()->Session()->visitedBlogItems = $visitedBlogItems;
            }
        }

        //generate breadcrumb
        $breadcrumb = $this->getCategoryBreadcrumb($blogArticleData['categoryId']);
        $blogDetailLink = $this->Front()->Router()->assemble([
            'sViewport' => 'blog', 'sCategory' => $blogArticleData['categoryId'],
            'action' => 'detail', 'blogArticle' => $blogArticleId,
        ]);

        $breadcrumb[] = ['link' => $blogDetailLink, 'name' => $blogArticleData['title']];

        $this->View()->assign(['sBreadcrumb' => $breadcrumb, 'sArticle' => $blogArticleData, 'rand' => Random::getAlphanumericString(32)]);
    }

    /**
     * Rating action method
     *
     * Save and review the blog comment and rating
     */
    public function ratingAction()
    {
        $blogArticleId = intval($this->Request()->blogArticle);

        if (!empty($blogArticleId)) {
            $blogArticleQuery = $this->getRepository()->getDetailQuery($blogArticleId);
            $blogArticleData = $blogArticleQuery->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

            $this->View()->sAction = $this->Request()->getActionName();

            if ($hash = $this->Request()->sConfirmation) {
                //customer confirmed the link in the mail
                $commentConfirmQuery = $this->getCommentConfirmRepository()->getConfirmationByHashQuery($hash);
                $getComment = $commentConfirmQuery->getOneOrNullResult();

                if ($getComment) {
                    $commentData = unserialize($getComment->getData());

                    //delete the data in the comment confirm table we don't need it anymore
                    Shopware()->Models()->remove($getComment);
                    Shopware()->Models()->flush();

                    $this->sSaveComment($commentData, $blogArticleId);

                    return $this->forward('detail');
                }
            }

            //validation
            if (empty($this->Request()->name)) {
                $sErrorFlag['name'] = true;
            }
            if (empty($this->Request()->headline)) {
                $sErrorFlag['headline'] = true;
            }

            if (empty($this->Request()->comment)) {
                $sErrorFlag['comment'] = true;
            }

            if (empty($this->Request()->points)) {
                $sErrorFlag['points'] = true;
            }

            if (!empty(Shopware()->Config()->CaptchaColor)) {
                /** @var \Shopware\Components\Captcha\CaptchaValidator $captchaValidator */
                $captchaValidator = $this->container->get('shopware.captcha.validator');

                if (!$captchaValidator->validate($this->Request())) {
                    $sErrorFlag['sCaptcha'] = true;
                }
            }

            $validator = $this->container->get('validator.email');
            if (!empty(Shopware()->Config()->sOPTINVOTE) && (empty($this->Request()->eMail) || !$validator->isValid($this->Request()->eMail))) {
                $sErrorFlag['eMail'] = true;
            }

            if (empty($sErrorFlag)) {
                if (!empty(Shopware()->Config()->sOPTINVOTE) && empty(Shopware()->Session()->sUserId)) {
                    $hash = Random::getAlphanumericString(32);

                    //save comment confirm for the optin
                    $blogCommentModel = new \Shopware\Models\CommentConfirm\CommentConfirm();
                    $blogCommentModel->setCreationDate(new DateTime('now'));
                    $blogCommentModel->setHash($hash);
                    $blogCommentModel->setData(serialize($this->Request()->getPost()));

                    Shopware()->Models()->persist($blogCommentModel);
                    Shopware()->Models()->flush();

                    $link = $this->Front()->Router()->assemble(['sViewport' => 'blog', 'action' => 'rating', 'blogArticle' => $blogArticleId, 'sConfirmation' => $hash]);

                    $context = ['sConfirmLink' => $link, 'sArticle' => ['title' => $blogArticleData['title']]];
                    $mail = Shopware()->TemplateMail()->createMail('sOPTINVOTE', $context);
                    $mail->addTo($this->Request()->getParam('eMail'));
                    $mail->send();
                } else {
                    //save comment
                    $commentData = $this->Request()->getPost();
                    $this->sSaveComment($commentData, $blogArticleId);
                }
            } else {
                $this->View()->sFormData = Shopware()->System()->_POST->toArray();
                $this->View()->sErrorFlag = $sErrorFlag;
            }
        }
        $this->forward('detail');
    }

    /**
     * Returns all data needed to display the date filter
     *
     * @param array $blogCategoryIds
     * @param array $selectedFilters
     *
     * @return array
     */
    public function getDateFilterData($blogCategoryIds, $selectedFilters)
    {
        //date filter query
        $dateFilterQuery = $this->repository->getDisplayDateFilterQuery($blogCategoryIds, $selectedFilters);
        $dateFilterData = $dateFilterQuery->getArrayResult();

        return $this->addLinksToFilter($dateFilterData, 'sFilterDate', 'dateFormatDate');
    }

    /**
     * Returns all data needed to display the author filter
     *
     * @param $blogCategoryIds
     * @param $filter | selected filters
     *
     * @return array
     */
    public function getAuthorFilterData($blogCategoryIds, $filter)
    {
        //date filter query
        $filterQuery = $this->repository->getAuthorFilterQuery($blogCategoryIds, $filter);
        $filterData = $filterQuery->getArrayResult();

        return $this->addLinksToFilter($filterData, 'sFilterAuthor', 'name');
    }

    /**
     * Returns all data needed to display the tags filter
     *
     * @param $blogCategoryIds
     * @param $filter | selected filters
     *
     * @return array
     */
    public function getTagsFilterData($blogCategoryIds, $filter)
    {
        //date filter query
        $filterQuery = $this->repository->getTagsFilterQuery($blogCategoryIds, $filter);
        $filterData = $filterQuery->getArrayResult();

        return $this->addLinksToFilter($filterData, 'sFilterTags', 'name');
    }

    /**
     * Returns listing breadcrumb
     *
     * @param int $categoryId
     *
     * @return array
     */
    public function getCategoryBreadcrumb($categoryId)
    {
        return array_reverse(Shopware()->Modules()->Categories()->sGetCategoriesByParent($categoryId));
    }

    /**
     * Save a new blog comment / voting
     *
     * @param array $commentData
     * @param int   $blogArticleId
     *
     * @throws Enlight_Exception
     */
    protected function sSaveComment($commentData, $blogArticleId)
    {
        if (empty($commentData)) {
            throw new Enlight_Exception('sSaveComment #00: Could not save comment');
        }

        $blogCommentModel = new \Shopware\Models\Blog\Comment();
        /** @var \Shopware\Models\Blog\Blog $blog */
        $blog = $this->getRepository()->find($blogArticleId);

        $blogCommentModel->setBlog($blog);
        $blogCommentModel->setCreationDate(new \DateTime());
        $blogCommentModel->setActive(false);

        $blogCommentModel->setName($commentData['name']);
        $blogCommentModel->setEmail($commentData['eMail']);
        $blogCommentModel->setHeadline($commentData['headline']);
        $blogCommentModel->setComment($commentData['comment']);
        $blogCommentModel->setPoints($commentData['points']);

        Shopware()->Models()->persist($blogCommentModel);
        Shopware()->Models()->flush();
    }

    /**
     * Returns all data needed to display the pager
     *
     * @param int   $totalResult
     * @param int   $limitEnd
     * @param int   $page
     * @param int   $categoryId
     * @param array $filters
     *
     * @return array
     */
    protected function getPagerData($totalResult, $limitEnd, $page, $categoryId, array $filters = [])
    {
        $numberPages = 0;

        // How many pages in this category?
        if ($limitEnd !== 0) {
            $numberPages = ceil($totalResult / $limitEnd);
        }

        // Make Array with page-structure to render in template
        $pages = [];

        // Delete empty filters and add needed parameters to array
        $userParams = array_filter($filters);
        $userParams['sViewport'] = 'blog';
        $userParams['sCategory'] = $categoryId;

        if ($numberPages > 1) {
            for ($i = 1; $i <= $numberPages; ++$i) {
                if ($i === $page) {
                    $pages['numbers'][$i]['markup'] = true;
                } else {
                    $pages['numbers'][$i]['markup'] = false;
                }
                $userParams['sPage'] = $i;

                $pages['numbers'][$i]['value'] = $i;
                $pages['numbers'][$i]['link'] = $this->Front()->Router()->assemble($userParams);
            }
            // Previous page
            if ($page !== 1) {
                $userParams['sPage'] = $page - 1;
                $pages['previous'] = $this->Front()->Router()->assemble($userParams);
            } else {
                $pages['previous'] = null;
            }
            // Next page
            if ($page !== $numberPages) {
                $userParams['sPage'] = $page + 1;
                $pages['next'] = $this->Front()->Router()->assemble($userParams);
            } else {
                $pages['next'] = null;
            }
        }

        return ['sNumberPages' => $numberPages, 'sPages' => $pages];
    }

    /**
     * Helper method to fill the data set with the right category link
     *
     * @param array  $filterData
     * @param string $requestParameterName
     * @param string $requestParameterValue
     * @param bool   $addRemoveProperty     | true to add a remove property to remove the selected filters
     *
     * @return mixed
     */
    protected function addLinksToFilter(array $filterData, $requestParameterName, $requestParameterValue, $addRemoveProperty = true)
    {
        foreach ($filterData as $key => $dateData) {
            $filterData[$key]['link'] = $this->blogBaseUrl . Shopware()->Modules()->Core()->sBuildLink(
                ['sPage' => 1, $requestParameterName => urlencode($dateData[$requestParameterValue])]
            );
        }
        if ($addRemoveProperty) {
            $filterData[] = ['removeProperty' => 1, 'link' => $this->blogBaseUrl . Shopware()->Modules()->Core()->sBuildLink(
                ['sPage' => 1, $requestParameterName => '']),
            ];
        }

        return $filterData;
    }

    /**
     * Helper method to create the filter array for the query
     *
     * @param string $filterDate
     * @param string $filterAuthor
     * @param string $filterTags
     *
     * @return array
     */
    protected function createFilter($filterDate, $filterAuthor, $filterTags)
    {
        //date filter
        $filter = [];
        if (!empty($filterDate)) {
            $filter[] = ['property' => 'blog.displayDate', 'value' => $filterDate . '%'];
        }

        //author filter
        if (!empty($filterAuthor)) {
            $filter[] = ['property' => 'author.name', 'value' => $filterAuthor];
        }

        //tags filter
        if (!empty($filterTags)) {
            $filter[] = ['property' => 'tags.name', 'value' => $filterTags];
        }

        return $filter;
    }

    /**
     * Helper method returns the blog category ids for the list query.
     *
     * @param array $blogCategories
     *
     * @return array
     */
    private function getBlogCategoryListIds(array $blogCategories)
    {
        $ids = [];
        foreach ($blogCategories as $blogCategory) {
            $ids[] = $blogCategory['id'];
        }

        return $ids;
    }
}
