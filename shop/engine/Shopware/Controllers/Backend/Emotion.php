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

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\CSRFWhitelistAware;
use Shopware\Components\Emotion\EmotionExporter;
use Shopware\Components\Emotion\Exception\MappingRequiredException;
use Shopware\Components\Model\ModelManager;
use Shopware\Models\Emotion\Element;
use Shopware\Models\Emotion\Emotion;
use Shopware\Models\Emotion\Library\Field;
use Shopware\Models\Shop\Shop;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Shopware_Controllers_Backend_Emotion extends Shopware_Controllers_Backend_ExtJs implements CSRFWhitelistAware
{
    /**
     * Emotion repository. Declared for an fast access to the emotion repository.
     *
     * @var \Shopware\Models\Emotion\Repository
     */
    public static $repository = null;

    /**
     * Entity Manager
     *
     * @var null
     */
    protected $manager = null;

    /**
     * @var Shopware_Components_Translation
     */
    private $translation;

    /**
     * {@inheritdoc}
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'export',
        ];
    }

    /**
     * Event listener function of the listing store of the emotion backend module.
     * Returns an array of all defined emotions.
     *
     * @return array
     */
    public function listAction()
    {
        $limit = $this->Request()->getParam('limit', null);
        $offset = $this->Request()->getParam('start', 0);
        $filter = $this->Request()->getParam('filter', null);
        $filterBy = $this->Request()->getParam('filterBy', null);
        $categoryId = $this->Request()->getParam('categoryId', null);

        $query = $this->getRepository()->getListingQuery($filter, $filterBy, $categoryId);

        $query->setFirstResult($offset)
            ->setMaxResults($limit);

        /** @var $statement PDOStatement */
        $statement = $query->execute();
        $emotions = $statement->fetchAll(PDO::FETCH_ASSOC);

        $query->select('COUNT(emotions.id) as count')
            ->resetQueryPart('groupBy')
            ->resetQueryPart('orderBy')
            ->setFirstResult(0)
            ->setMaxResults(1);

        $statement = $query->execute();
        $count = $statement->fetch(PDO::FETCH_COLUMN);

        $this->View()->assign([
            'success' => true,
            'data' => $emotions,
            'total' => (int) $count,
        ]);
    }

    /**
     * Returns all master landing pages.
     */
    public function getMasterLandingPagesAction()
    {
        $id = $this->Request()->getParam('id', null);
        $ownId = $this->Request()->getParam('ownId', null);

        $builder = $this->getRepository()->getListingQuery([], 'onlyLandingPageMasters');

        if ($id) {
            $builder->where('emotions.id = :id')
                ->setParameters(['id' => $id])
                ->setFirstResult(0)
                ->setMaxResults(1);
        }

        if ($ownId) {
            $builder->andWhere('emotions.id != :ownId')
                ->setParameter('ownId', $ownId);
        }

        $builder->andWhere('emotions.is_landingpage = 1')
            ->andWhere('emotions.parent_id IS NULL');

        $statement = $builder->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    /**
     * Event listener function of the emotion detail store of the backend module.
     * Fired when the user clicks the edit button in the listing. The function returns
     * all data for a single emotion.
     */
    public function detailAction()
    {
        $id = $this->Request()->getParam('id', null);
        $repository = $this->getRepository();

        $query = $repository->getEmotionDetailQuery($id);
        $mediaService = Shopware()->Container()->get('shopware_media.media_service');

        $emotion = $query->getArrayResult();
        $emotion = $emotion[0];

        if (!empty($emotion['categories'])) {
            $emotion['categories'] = array_column($emotion['categories'], 'id');
        }

        $validFrom = $emotion['validFrom'];
        $validTo = $emotion['validTo'];

        /** @var $validFrom \DateTime */
        if ($validFrom instanceof \DateTime) {
            $emotion['validFrom'] = $validFrom->format('d.m.Y');
            $emotion['validFromTime'] = $validFrom->format('H:i');
        }

        /** @var $validTo \DateTime */
        if ($validTo instanceof \DateTime) {
            $emotion['validTo'] = $validTo->format('d.m.Y');
            $emotion['validToTime'] = $validTo->format('H:i');
        }

        $elementIds = array_column($emotion['elements'], 'id');
        $viewports = $repository->getElementsViewports($elementIds);

        foreach ($emotion['elements'] as &$element) {
            $elementQuery = $repository->getElementDataQuery($element['id'], $element['componentId']);
            $componentData = $elementQuery->getArrayResult();
            $data = [];

            foreach ($componentData as $entry) {
                switch (strtolower($entry['valueType'])) {
                    case 'json':
                        if ($entry['value'] != '') {
                            $value = Zend_Json::decode($entry['value']);
                        } else {
                            $value = null;
                        }
                        break;
                    case 'string':
                    default:
                        $value = $entry['value'];
                        break;
                }

                if ($entry['name'] === 'file' ||
                    $entry['name'] === 'image' ||
                    $entry['name'] === 'fallback_picture'
                ) {
                    $value = $mediaService->getUrl($value);
                }

                if (in_array($entry['name'], ['selected_manufacturers', 'banner_slider'])) {
                    foreach ($value as $k => $v) {
                        if (isset($v['path'])) {
                            $value[$k]['path'] = $mediaService->getUrl($v['path']);
                        }
                    }
                }

                $data[] = [
                    'id' => $entry['id'],
                    'fieldId' => $entry['fieldId'],
                    'valueType' => $entry['valueType'],
                    'key' => $entry['name'],
                    'value' => $value,
                ];
            }
            $element['data'] = $data;

            $element['viewports'] = [];

            if (isset($viewports[$element['id']])) {
                $element['viewports'] = $viewports[$element['id']];
            }
        }

        if (!empty($emotion['shops'])) {
            foreach ($emotion['shops'] as &$shop) {
                $seoUrl = $this->getSeoUrlFromRouter($emotion['id'], $shop['id']);
                if (!$seoUrl) {
                    continue;
                }
                $shop['seoUrl'] = $seoUrl;
            }
        }

        $this->View()->assign([
            'success' => true,
            'data' => $emotion,
            'total' => 1,
        ]);
    }

    /**
     * Exports emotion data and assets to zip archive
     */
    public function exportAction()
    {
        $this->Front()->Plugins()->ViewRenderer()->setNoRender();
        $this->Front()->Plugins()->Json()->setRenderer(false);

        $emotionId = $this->Request()->get('emotionId');

        if (!$emotionId) {
            echo 'Parameter emotionId not found!';

            return;
        }

        /** @var EmotionExporter $exporter */
        $exporter = $this->container->get('shopware.emotion.emotion_exporter');

        try {
            /** @var string $exportFilePath */
            $exportFilePath = $exporter->export($emotionId);
        } catch (\Exception $e) {
            echo $e->getMessage();

            return;
        }

        @set_time_limit(0);
        $this->Response()
            ->setHeader('Content-type', 'application/zip')
            ->setHeader('Content-Transfer-Encoding', 'binary')
            ->setHeader('Content-disposition', 'attachment; filename="' . basename($exportFilePath) . '"')
            ->sendHeaders();

        readfile($exportFilePath);
        $this->container->get('file_system')->remove($exportFilePath);

        exit;
    }

    /**
     * Uploads emotion zip archive to shopware file system
     *
     * @throws Exception
     */
    public function uploadAction()
    {
        /** @var $file UploadedFile */
        $file = Symfony\Component\HttpFoundation\Request::createFromGlobals()->files->get('emotionfile');
        $fileSystem = $this->container->get('file_system');

        if ($file->getClientMimeType() !== 'application/zip' && strtolower($file->getClientOriginalExtension()) !== 'zip') {
            $name = $file->getClientOriginalName();

            $fileSystem->remove($file->getPathname());

            $this->View()->assign([
                'success' => false,
                'message' => sprintf(
                    'Uploaded file %s is no zip file',
                    $name
                ),
            ]);

            return;
        }
        $downloadPath = $this->container->getParameter('kernel.root_dir') . '/files/downloads/';

        if (!is_writable($downloadPath)) {
            $this->View()->assign([
                'success' => false,
                'error' => sprintf("Target Directory %s isn't writable", $downloadPath),
            ]);

            return;
        }

        $fileSystem->copy($file, $downloadPath . $file->getClientOriginalName());
        $fileSystem->remove($file->getPathname());

        $this->View()->assign([
            'success' => true,
            'filePath' => $downloadPath . $file->getClientOriginalName(),
        ]);
    }

    /**
     * Execute emotion import on uploaded zip archive.
     */
    public function importAction()
    {
        $filePath = $this->Request()->get('filePath');

        $emotionImporter = $this->container->get('shopware.emotion.emotion_importer');
        $preset = $emotionImporter->import($filePath);

        $this->View()->assign([
            'success' => true,
            'presetId' => $preset->getId(),
            'presetData' => $preset->getPresetData(),
            'emotionTranslations' => $preset->getEmotionTranslations(),
        ]);
    }

    /**
     * Execute cleanup on imported emotion files.
     */
    public function afterImportAction()
    {
        $filePath = $this->Request()->get('filePath');
        $presetId = $this->Request()->get('presetId');

        if (!$filePath) {
            $this->View()->assign([
                'success' => false,
            ]);

            return;
        }

        $emotionImporter = $this->container->get('shopware.emotion.emotion_importer');
        $emotionImporter->cleanupImport($filePath, $presetId);

        $this->View()->assign([
            'success' => true,
        ]);
    }

    public function importTranslationsAction()
    {
        /** @var Enlight_Controller_Request_Request $request */
        $request = $this->Request();
        $emotionId = $request->get('emotionId');
        $emotionTranslations = $request->get('emotionTranslations');
        $autoMapping = $request->get('autoMapping');

        if (!isset($autoMapping)) {
            $autoMapping = true;
        }

        if (!$emotionId || !$emotionTranslations) {
            $this->View()->assign([
                'success' => false,
            ]);

            return;
        }
        $emotionTranslations = json_decode($emotionTranslations, true);
        $translationImporter = $this->container->get('shopware.emotion.translation_importer');

        try {
            $translationImporter->importTranslations($emotionId, $emotionTranslations, $autoMapping);
        } catch (MappingRequiredException $e) {
            $this->View()->assign([
                'success' => false,
                'mappingRequired' => true,
                'emotionTranslations' => $emotionTranslations,
                'shops' => $translationImporter->getLocaleMapping(),
            ]);

            return;
        }

        $this->View()->assign([
            'success' => true,
        ]);
    }

    /**
     * Event listener function of the library store.
     *
     * @return array
     */
    public function libraryAction()
    {
        $builder = Shopware()->Models()->createQueryBuilder();
        $builder->select(['components', 'fields'])
            ->from('Shopware\Models\Emotion\Library\Component', 'components')
            ->leftJoin('components.fields', 'fields')
            ->orderBy('components.id', 'ASC')
            ->addOrderBy('fields.position', 'ASC');

        $components = $builder->getQuery()->getArrayResult();
        $this->View()->assign([
            'success' => true,
            'data' => $components,
        ]);
    }

    /**
     * Model event listener function which fired when the user configure an emotion over the backend
     * module and clicks the save button.
     */
    public function saveAction()
    {
        try {
            $data = $this->Request()->getParams();

            $emotion = $this->saveEmotion($data);

            if ($emotion === null) {
                $this->View()->assign([
                    'data' => $this->Request()->getParams(),
                    'success' => false,
                ]);

                return;
            }

            $alreadyExists = $this->hasEmotionForSameDeviceType($data['categoryId']);

            $data['id'] = $emotion->getId();

            $this->generateEmotionSeoUrls($emotion);
            $this->removePreview($emotion->getId());

            $this->View()->assign([
                'data' => $data,
                'success' => true,
                'alreadyExists' => $alreadyExists,
            ]);
        } catch (\Doctrine\ORM\ORMException $e) {
            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Model event listener function which fired when the user configure an emotion over the backend
     * module and clicks the save button.
     */
    public function savePreviewAction()
    {
        try {
            $data = $this->Request()->getParams();

            if (empty($data['id'])) {
                throw new \Shopware\Components\Api\Exception\NotFoundException('The emotion must exists before previewing it.');
            }

            $data['previewId'] = $data['id'];
            $data['previewSecret'] = \Shopware\Components\Random::getAlphanumericString(32);
            $data['active'] = false;

            /** @var Emotion $previewEmotion */
            $previewEmotion = $this->findPreviewEmotion($data['id']);
            if ($previewEmotion) {
                $previewEmotion->getElements()->clear();
                $this->getManager()->flush($previewEmotion);

                $data['id'] = $previewEmotion->getId();
            } else {
                unset($data['id']);
            }

            $emotion = $this->saveEmotion($data);

            if ($emotion === null) {
                $this->View()->assign([
                    'data' => $this->Request()->getParams(),
                    'success' => false,
                ]);

                return;
            }

            $data['id'] = $emotion->getId();

            $this->View()->assign([
                'data' => $data,
                'success' => true,
            ]);
        } catch (\Doctrine\ORM\ORMException $e) {
            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (\Shopware\Components\Api\Exception\NotFoundException $e) {
            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /***
     * Function for only updating active status and position
     * of an emotion.
     *
     * @return void
     */
    public function updateStatusAndPositionAction()
    {
        if (!$this->Request()->has('id')) {
            $this->View()->assign([
                'success' => false,
                'data' => $this->Request()->getParams(),
            ]);

            return;
        }

        try {
            $data = $this->Request()->getParams();
            /** @var ModelManager $manager */
            $manager = $this->getManager();
            /** @var Emotion $emotion */
            $emotion = $this->getRepository()->find($data['id']);

            if (!$emotion) {
                $this->View()->assign([
                    'success' => false,
                    'data' => $this->Request()->getParams(),
                    'emotion' => false,
                ]);

                return;
            }

            $emotion->setActive($data['active']);
            $emotion->setPosition($data['position']);
            $emotion->setModified(new \DateTime());

            $manager->flush();

            $this->View()->assign([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Doctrine\ORM\ORMException $e) {
            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Model event listener function which fired when the user select an emotion row
     * in the backend listing and clicks the remove button or the action column.
     *
     * @return mixed
     */
    public function deleteAction()
    {
        try {
            //get posted customers
            $emotions = $this->Request()->getParam('emotions', [['id' => $this->Request()->getParam('id')]]);

            //iterate the customers and add the remove action
            foreach ($emotions as $emotion) {
                if (empty($emotion['id'])) {
                    continue;
                }
                /** @var $entity Emotion */
                $entity = $this->getRepository()->find($emotion['id']);

                /** @var \Shopware\Models\Emotion\Element $element */
                foreach ($entity->getElements() as $element) {
                    $this->getTranslation()->delete(null, 'emotionElement', $element->getId());
                }

                // delete created previews
                $this->removePreview($entity->getId());

                Shopware()->Models()->remove($entity);
            }

            // delete corresponding translations
            $this->deleteTranslations($emotions);

            Shopware()->Models()->flush();

            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => true,
            ]);
        } catch (\Doctrine\ORM\ORMException $e) {
            $this->View()->assign([
                'data' => $this->Request()->getParams(),
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function duplicateAction()
    {
        $emotionId = (int) $this->Request()->getParam('emotionId');
        $device = $this->Request()->getParam('forDevice');

        if (!$emotionId) {
            $this->View()->assign(['success' => false]);

            return;
        }

        /** @var Emotion $emotion */
        $emotion = Shopware()->Models()->find('Shopware\Models\Emotion\Emotion', $emotionId);

        if (!$emotion) {
            $this->View()->assign(['success' => false]);

            return;
        }

        $new = clone $emotion;

        switch (true) {
            case $emotion->getIsLandingPage() && $emotion->getParentId():
                $new->setParentId($emotion->getParentId());
                break;
            case $emotion->getIsLandingPage():
                $new->setParentId($emotion->getId());
                break;
        }

        $copyName = $emotion->getName() . ' - Copy';
        $new->setName($copyName);

        $new->setDevice($device);
        $new->setCreateDate(new \DateTime());
        $new->setModified(new \DateTime());

        Shopware()->Models()->persist($new);
        Shopware()->Models()->flush();

        if (!empty($new->getId())) {
            $this->copyEmotionTranslations($emotion->getId(), $new->getId());
            $this->copyElementTranslations($emotion, $new);
            $persister = Shopware()->Container()->get('shopware_attribute.data_persister');
            $persister->cloneAttribute('s_emotion_attributes', $emotion->getId(), $new->getId());
        }

        $this->View()->assign(['success' => true, 'data' => []]);
    }

    /**
     * Controller action  to create a new template.
     * Use the internal "saveTemplate" function.
     * The request parameters are used as template/model data.
     */
    public function createTemplateAction()
    {
        $this->View()->assign(
            $this->saveTemplate(
                $this->Request()->getParams()
            )
        );
    }

    /**
     * Controller action to update an existing template.
     * Use the internal "saveTemplate" function.
     * The request parameters are used as template/model data.
     * The updateTemplateAction should have a "id" request parameter which
     * contains the id of the existing template.
     */
    public function updateTemplateAction()
    {
        $this->View()->assign(
            $this->saveTemplate(
                $this->Request()->getParams()
            )
        );
    }

    /**
     * Controller action to delete a single template.
     * Use the internal "deleteTemplate" function.
     * Expects the template id as request parameter "id".
     */
    public function deleteTemplateAction()
    {
        $this->View()->assign(
            $this->deleteTemplate(
                $this->Request()->getParam('id', null)
            )
        );
    }

    public function deleteManyTemplatesAction()
    {
        $this->View()->assign(
            $this->deleteManyTemplates(
                $this->Request()->getParam('records', [])
            )
        );
    }

    /**
     * Controller action to duplicate a single template.
     * Use the internal "duplicateTemplate" function.
     * Expects the template id as request parameter "id".
     */
    public function duplicateTemplateAction()
    {
        $this->View()->assign(
            $this->duplicateTemplate(
                $this->Request()->getParam('id', null)
            )
        );
    }

    /**
     * Controller action to get a list of all defined templates.
     * You can paginate the list over the request parameters
     * "start" and "limit".
     * Use the internal "getTemplates" function.
     */
    public function getTemplatesAction()
    {
        $this->View()->assign(
            $this->getTemplates(
                $this->Request()->getParam('start', null),
                $this->Request()->getParam('limit', null)
            )
        );
    }

    protected function initAcl()
    {
        $this->addAclPermission('list', 'read', 'Insufficient permissions');
        $this->addAclPermission('detail', 'read', 'Insufficient permissions');
        $this->addAclPermission('library', 'read', 'Insufficient permissions');
        $this->addAclPermission('fill', 'read', 'Insufficient permissions');

        $this->addAclPermission('delete', 'delete', 'Insufficient permissions');

        $this->addAclPermission('save', 'save', 'Insufficient permissions');
        $this->addAclPermission('updateStatusAndPosition', 'save', 'Insufficient permissions');
        $this->addAclPermission('upload', 'save', 'Insufficient permissions');
        $this->addAclPermission('import', 'save', 'Insufficient permissions');
        $this->addAclPermission('afterImport', 'save', 'Insufficient permissions');

        $this->addAclPermission('duplicate', 'create', 'Insufficient permissions');
    }

    /**
     * Helper function to get access on the static declared repository
     *
     * @return null|Shopware\Models\Emotion\Repository
     */
    protected function getRepository()
    {
        if (self::$repository === null) {
            self::$repository = Shopware()->Models()->getRepository('Shopware\Models\Emotion\Emotion');
        }

        return self::$repository;
    }

    /**
     * The delete many templates function is used from the controller action deleteManyTemplatesAction
     * and contains the real deleteMany process. As parameter the function expects
     * and two dimensional array with model ids:
     *
     * Example:
     * array(
     *    array('id' => 1),
     *    array('id' => 2),
     *    ...
     * )
     *
     * The function iterates the passed records array and calls for each record
     * the "deleteTemplate" function. If the delete action for the item was successfully,
     * the delete function returns the following array('success' => true).
     * If the delete function fails, the delete action returns array('success' => false, 'error'),
     * this errors will be collected.
     * Notice: The iteration don't stops if an errors occurs. It will be continue with the next record.
     *
     * After all records deleted, the function returns array('success' => true) if no errors occurs.
     * If one or more errors occurred the function return an array like this:
     *  array(
     *      'success' => false,
     *      'error' => array('Error 1', 'Error 2', ...)
     * )
     *
     * @param $records
     *
     * @return array
     */
    protected function deleteManyTemplates($records)
    {
        if (empty($records)) {
            return ['success' => false, 'error' => 'No templates passed'];
        }
        $errors = [];
        foreach ($records as $record) {
            if (empty($record['id'])) {
                continue;
            }
            $result = $this->deleteTemplate($record['id']);
            if ($result['success'] === false) {
                $errors[] = [$result['error']];
            }
        }

        return [
            'success' => empty($errors),
            'error' => $errors,
        ];
    }

    /**
     * Returns a list with all defined templates.
     * The function return value is every time an array.
     *
     * Success case:
     *  array('success' => true, 'total' => Total listing count, 'data' => All defined templates)
     *
     * Failure case:
     *  array('success' => false, 'error' => Error message)
     *
     * @param null $offset
     * @param null $limit
     *
     * @return array
     */
    protected function getTemplates($offset = null, $limit = null)
    {
        try {
            $query = $this->getTemplatesQuery($offset, $limit);
            $paginator = $this->getQueryPaginator($query->getQuery());

            $result = [
                'success' => true,
                'total' => $paginator->count(),
                'data' => $paginator->getIterator()->getArrayCopy(),
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }

        return $result;
    }

    /**
     * @param null $offset
     * @param null $limit
     *
     * @return Doctrine\ORM\QueryBuilder|Shopware\Components\Model\QueryBuilder
     */
    protected function getTemplatesQuery($offset = null, $limit = null)
    {
        $builder = Shopware()->Models()->createQueryBuilder();
        $builder->select(['templates'])
            ->from('Shopware\Models\Emotion\Template', 'templates');

        if ($offset !== null && $limit !== null) {
            $builder->setFirstResult($offset)
                ->setMaxResults($limit);
        }

        return $builder;
    }

    /**
     * Deletes a single template which will be identified over
     * the passed id parameter. The return value is
     * every time an array.
     *
     * Success case:
     *  array('success' => true)
     *
     * Failure case:
     *  array('success' => false, 'error' => An error message)
     *
     *
     * @param null $id
     *
     * @return array
     */
    protected function deleteTemplate($id = null)
    {
        if (empty($id)) {
            return ['success' => false, 'error' => "The request parameter id don't passed!"];
        }

        try {
            $template = Shopware()->Models()->find('Shopware\Models\Emotion\Template', $id);
            if (!$template instanceof \Shopware\Models\Emotion\Template) {
                return ['success' => false, 'error' => 'The passed template id exist no more!'];
            }
            Shopware()->Models()->remove($template);
            Shopware()->Models()->flush();
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }

        return ['success' => true];
    }

    /**
     * Duplicates a single template which will be identified over
     * the passed id parameter. The return value is
     * every time an array. The duplicate function used
     * the php __clone function of the model.
     *
     * Success case:
     *  array('success' => true, 'data' => New Template data)
     *
     * Failure case:
     *  array('success' => false, 'error' => An error message)
     *
     *
     * @param null $id
     *
     * @return array
     */
    protected function duplicateTemplate($id = null)
    {
        if (empty($id)) {
            return ['success' => false, 'error' => "The request parameter templateId don't passed!"];
        }
        $data = [];

        try {
            $template = Shopware()->Models()->find('Shopware\Models\Emotion\Template', $id);
            if (!$template instanceof \Shopware\Models\Emotion\Template) {
                return ['success' => false, 'error' => 'The passed template id exist no more!'];
            }

            $new = clone $template;
            Shopware()->Models()->persist($new);
            Shopware()->Models()->flush();

            $data = $this->getTemplate($new->getId());
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }

        return ['success' => true, 'data' => $data];
    }

    /**
     * Updates or creates a single template. If the data parameter contains
     * an "id" property, this property is used to identify an existing template.
     * The return value is every time an array.
     *
     * Success case:
     *  array('success' => true, 'data' => New Template data)
     *
     * Failure case:
     *  array('success' => false, 'error' => An error message)
     *
     * @param $data
     *
     * @return array
     */
    protected function saveTemplate($data)
    {
        $result = [];

        try {
            //we have to remove the emotions to prevent an assignment from this side!
            unset($data['emotions']);
            if (!empty($data['id'])) {
                $template = Shopware()->Models()->find('Shopware\Models\Emotion\Template', $data['id']);
            } else {
                $template = new \Shopware\Models\Emotion\Template();
            }

            if (!$template instanceof \Shopware\Models\Emotion\Template) {
                return ['success' => false, 'error' => 'The passed template id exist no more!'];
            }

            $template->fromArray($data);
            Shopware()->Models()->persist($template);
            Shopware()->Models()->flush();

            $result = $this->getTemplate($template->getId());
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }

        return ['success' => true, 'data' => $result];
    }

    /**
     * Helper function to get the array data of a single template.
     * The passed $id parameter is used to identify the template.
     *
     * Success case:
     *  array(Data of the template)
     *
     * Failure case:
     *  null
     *
     * @param null $id
     *
     * @return array
     */
    protected function getTemplate($id)
    {
        $builder = Shopware()->Models()->createQueryBuilder();
        $builder->select(['template'])
            ->from('Shopware\Models\Emotion\Template', 'template')
            ->where('template.id = :id')
            ->setParameter('id', $id);

        return $builder->getQuery()->getOneOrNullResult(
            \Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY
        );
    }

    /**
     * Internal helper function to get access to the entity manager.
     */
    private function getManager()
    {
        if ($this->manager === null) {
            $this->manager = Shopware()->Models();
        }

        return $this->manager;
    }

    private function getTranslation()
    {
        if ($this->translation === null) {
            $this->translation = $this->container->get('translation');
        }

        return $this->translation;
    }

    /**
     * @param int $emotionId
     *
     * @return Emotion
     */
    private function findPreviewEmotion($emotionId)
    {
        $builder = $this->container->get('models')->createQueryBuilder();
        $emotion = $builder->select('emotion')
                ->from(Emotion::class, 'emotion')
                ->where('emotion.previewId = :previewId')
                ->setParameter('previewId', $emotionId)
                ->getQuery()
                ->getOneOrNullResult(\Doctrine\ORM\AbstractQuery::HYDRATE_OBJECT);

        return $emotion;
    }

    /**
     * Method for saving a single emotion model.
     * Processes the provided data and creates necessary associations.
     *
     * @param array $data
     *
     * @return Emotion|null
     */
    private function saveEmotion(array $data)
    {
        /** @var $namespace Enlight_Components_Snippet_Namespace */
        $namespace = Shopware()->Snippets()->getNamespace('backend/emotion');

        if (!empty($data['id'])) {
            /** @var $emotion Emotion */
            $emotion = Shopware()->Models()->find('Shopware\Models\Emotion\Emotion', $data['id']);

            if (!$emotion) {
                $this->View()->assign([
                    'success' => false,
                    'data' => $this->Request()->getParams(),
                    'message' => $namespace->get('no_valid_id', 'No valid emotion id passed.'), ]
                );

                return null;
            }
        } else {
            /** @var $emotion Emotion */
            $emotion = new Emotion();
            $emotion->setCreateDate(new \DateTime());
        }

        $template = null;
        if (!empty($data['templateId'])) {
            /** @var $template \Shopware\Models\Emotion\Template */
            $template = Shopware()->Models()->find('Shopware\Models\Emotion\Template', $data['templateId']);
        }

        $validFrom = null;
        if (!empty($data['validFrom']) &&
            !empty($data['validFromTime'])) {
            $fromDate = new \DateTime($data['validFrom']);
            $fromTime = new \DateTime($data['validFromTime']);

            $validFrom = $fromDate->format('d.m.Y') . ' ' . $fromTime->format('H:i');
        }

        $validTo = null;
        if (!empty($data['validTo']) &&
            !empty($data['validToTime'])) {
            $toDate = new \DateTime($data['validTo']);
            $toTime = new \DateTime($data['validToTime']);

            $validTo = $toDate->format('d.m.Y') . ' ' . $toTime->format('H:i');
        }

        $categories = new \Doctrine\Common\Collections\ArrayCollection();
        if (!empty($data['categories'])) {
            foreach ($data['categories'] as $category) {
                $cat = Shopware()->Models()->find('Shopware\Models\Category\Category', $category);

                if ($cat !== null) {
                    $categories->add($cat);
                }
            }
        }

        $shops = new \Doctrine\Common\Collections\ArrayCollection();
        if (!empty($data['shops'])) {
            foreach ($data['shops'] as $shop) {
                $subShop = Shopware()->Models()->find('Shopware\Models\Shop\Shop', $shop['id']);

                if ($shop !== null) {
                    $shops->add($subShop);
                }
            }
        }

        $elements = [];
        if (!empty($data['elements'])) {
            $elements = $this->createElements($emotion, $data['elements']);
        }

        if (Shopware()->Container()->get('Auth')->getIdentity()->id) {
            /** @var $user \Shopware\Models\User\User */
            $user = Shopware()->Models()->find('Shopware\Models\User\User', Shopware()->Container()->get('Auth')->getIdentity()->id);
            $emotion->setUser($user);
        }

        $emotion->setModified(new \DateTime());
        $emotion->setName($data['name']);
        $emotion->setValidFrom($validFrom);
        $emotion->setValidTo($validTo);
        $emotion->setShops($shops);
        $emotion->setCategories($categories);
        $emotion->setElements($elements);
        $emotion->setTemplate($template);
        $emotion->setParentId(!empty($data['parentId']) ? $data['parentId'] : null);
        $emotion->setActive(!empty($data['active']));
        $emotion->setPosition(!empty($data['position']) ? $data['position'] : 1);
        $emotion->setShowListing(!empty($data['showListing']));
        $emotion->setFullscreen(!empty($data['fullscreen']));
        $emotion->setDevice((!empty($data['device']) || $data['device'] === '0') ? $data['device'] : null);
        $emotion->setMode($data['mode']);
        $emotion->setRows($data['rows']);
        $emotion->setCols($data['cols']);
        $emotion->setCellSpacing($data['cellSpacing']);
        $emotion->setCellHeight($data['cellHeight']);
        $emotion->setArticleHeight($data['articleHeight']);
        $emotion->setIsLandingPage(!empty($data['isLandingPage']));
        $emotion->setSeoTitle($data['seoTitle']);
        $emotion->setSeoKeywords($data['seoKeywords']);
        $emotion->setSeoDescription($data['seoDescription']);
        $emotion->setPreviewId(array_key_exists('previewId', $data) ? $data['previewId'] : null);
        $emotion->setPreviewSecret(array_key_exists('previewSecret', $data) ? $data['previewSecret'] : null);
        $emotion->setCustomerStreamIds($data['customerStreamIds'] ?: null);
        $emotion->setReplacement($data['replacement'] ?: null);

        Shopware()->Models()->persist($emotion);
        Shopware()->Models()->flush();

        return $emotion;
    }

    /**
     * Helper method for creating associated emotion elements.
     *
     * @param Emotion $emotion
     * @param array   $emotionElements
     *
     * @return array
     */
    private function createElements(Emotion $emotion, array $emotionElements)
    {
        foreach ($emotionElements as &$item) {
            if (!empty($item['componentId'])) {
                /** @var $component \Shopware\Models\Emotion\Library\Component */
                $component = Shopware()->Models()->find('Shopware\Models\Emotion\Library\Component', $item['componentId']);

                if ($component !== null) {
                    $item['component'] = $component;
                }
            }

            if (!empty($item['data'])) {
                $item['data'] = $this->createElementData($emotion, $item, $item['data']);
            }

            if (!empty($item['viewports'])) {
                $item['viewports'] = $this->createElementViewports($emotion, $item, $item['viewports']);
            }
        }

        return $emotionElements;
    }

    /**
     * Helper method for creating associated element viewports.
     *
     * @param Emotion $emotion
     * @param array   $element
     * @param array   $elementViewports
     *
     * @return array
     */
    private function createElementViewports(Emotion $emotion, array $element, array $elementViewports)
    {
        foreach ($elementViewports as &$viewport) {
            $viewport['emotion'] = $emotion;
        }

        return $elementViewports;
    }

    /**
     * Helper method for creating associated element data.
     *
     * @param Emotion $emotion
     * @param array   $element
     * @param array   $elementData
     *
     * @return array
     */
    private function createElementData(Emotion $emotion, array $element, array $elementData)
    {
        foreach ($elementData as $key => &$item) {
            if (empty($item['fieldId'])) {
                unset($elementData[$key]);
                continue;
            }

            /** @var $field Field */
            $field = Shopware()->Models()->find('Shopware\Models\Emotion\Library\Field', $item['fieldId']);
            $item['field'] = $field;

            $item['component'] = $element['component'];
            $item['emotion'] = $emotion;

            $item['value'] = $this->processDataFieldValue($field, $item['value']);
        }

        return $elementData;
    }

    /**
     * Method for processing the different value types of the data fields.
     *
     * @param Field $field
     * @param $value
     *
     * @return string
     */
    private function processDataFieldValue(Field $field, $value)
    {
        $valueType = strtolower($field->getValueType());
        $xType = $field->getXType();

        $mediaService = Shopware()->Container()->get('shopware_media.media_service');
        $mediaFields = $this->getMediaXTypes();

        if ($valueType === 'json') {
            if (is_array($value)) {
                foreach ($value as &$val) {
                    $val['path'] = $mediaService->normalize($val['path']);
                }
            }

            $value = Zend_Json::encode($value);
        }

        if (in_array($xType, $mediaFields)) {
            if ($mediaService->isEncoded($value)) {
                $value = $mediaService->normalize($value);
            }
        }

        return $value;
    }

    /**
     * Fetch all emotions with same category Id and
     * mark existing emotions with same devices and category
     *
     * @param int $categoryId
     *
     * @return bool
     */
    private function hasEmotionForSameDeviceType($categoryId)
    {
        $builder = Shopware()->Models()->createQueryBuilder();
        $builder
            ->select(['emotions', 'categories'])
            ->from('Shopware\Models\Emotion\Emotion', 'emotions')
            ->leftJoin('emotions.categories', 'categories')
            ->where('categories.id = :categoryId');

        $builder->setParameters(['categoryId' => $categoryId]);
        $result = $builder->getQuery()->getArrayResult();

        $usedDevices = [];
        foreach ($result as $emotion) {
            $devices = explode(',', $emotion['device']);
            foreach ($devices as $device) {
                if (!in_array($device, $usedDevices)) {
                    $usedDevices[] = $device;
                } else {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Copies the translations of an emotion to a new one.
     *
     * @param int $oldId
     * @param int $newId
     */
    private function copyEmotionTranslations($oldId, $newId)
    {
        if (empty($oldId) || empty($newId)) {
            return;
        }

        /** @var \Doctrine\DBAL\Query\QueryBuilder $query */
        $query = Shopware()->Container()->get('dbal_connection')->createQueryBuilder();

        $languageIds = $query->select('id')
            ->from('s_core_shops', 'shops')
            ->execute()
            ->fetchAll(PDO::FETCH_COLUMN);

        foreach ($languageIds as $id) {
            $data = $this->getTranslation()->read($id, 'emotion', $oldId);

            if (empty($data)) {
                continue;
            }

            $data['name'] = $data['name'] . ' - Copy';
            $this->getTranslation()->write($id, 'emotion', $newId, $data);
        }
    }

    /**
     * Deletes all corresponding translations for the given emotions.
     *
     * @param array $emotions
     */
    private function deleteTranslations(array $emotions)
    {
        if (empty($emotions)) {
            return;
        }

        /** @var \Doctrine\DBAL\Query\QueryBuilder $query */
        $query = Shopware()->Container()->get('dbal_connection')->createQueryBuilder();

        $languageIds = $query->select('id')
            ->from('s_core_shops', 'shops')
            ->execute()
            ->fetchAll(PDO::FETCH_COLUMN);

        foreach ($emotions as $emotion) {
            if (empty($emotion['id'])) {
                continue;
            }

            foreach ($languageIds as $id) {
                $this->getTranslation()->delete($id, 'emotion', $emotion['id']);
            }
        }
    }

    /**
     * @param     $query         \Doctrine\ORM\Query
     * @param int $hydrationMode
     *
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    private function getQueryPaginator($query, $hydrationMode = \Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY)
    {
        $query->setHydrationMode($hydrationMode);

        return $this->getModelManager()->createPaginator($query);
    }

    /**
     * Collects all media related x_types which needs to be normalized
     *
     * @return array
     */
    private function getMediaXTypes()
    {
        $mediaFields = new ArrayCollection([
            'mediaselectionfield',
            'mediatextfield',
        ]);

        $mediaFields = $this->get('events')->collect('Shopware_Plugin_Collect_MediaXTypes', $mediaFields);

        return $mediaFields->toArray();
    }

    /**
     * @param Emotion $emotion
     * @param Emotion $clonedEmotion
     */
    private function copyElementTranslations(Emotion $emotion, Emotion $clonedEmotion)
    {
        $oldObjectKeys = [];
        $sql = <<<'EOD'
INSERT INTO `s_core_translations` (`objecttype`, `objectdata`, `objectkey`, `objectlanguage`, `dirty`)
SELECT `objecttype`,
`objectdata`,
:objectKey as 'objectkey',
`objectlanguage`,
`dirty`
FROM `s_core_translations`
WHERE objectkey = :oldObjectKey AND `objecttype` = 'emotionElement'
EOD;

        /** @var Element $el */
        foreach ($emotion->getElements() as $el) {
            $key = $this->getElementIdentifier($el);
            $oldObjectKeys[$key] = $el->getId();
        }

        /** @var Element $el */
        foreach ($clonedEmotion->getElements() as $el) {
            $key = $this->getElementIdentifier($el);

            Shopware()->Db()->executeQuery($sql, [
                ':objectKey' => $el->getId(),
                ':oldObjectKey' => $oldObjectKeys[$key],
            ]);
        }
    }

    /**
     * creates a unique identifier string based on the grid position
     *
     * @param Element $el
     *
     * @return string
     */
    private function getElementIdentifier(Element $el)
    {
        return $el->getStartCol() . $el->getStartRow() . $el->getEndCol() . $el->getEndRow();
    }

    /**
     * @param Emotion
     */
    private function generateEmotionSeoUrls(Emotion $emotion)
    {
        /** @var Shopware_Components_SeoIndex $seoIndexer */
        $seoIndexer = Shopware()->Container()->get('SeoIndex');
        $module = Shopware()->Modules()->RewriteTable();
        $shops = $emotion->getShops();
        $emotionData = [
            'id' => $emotion->getId(),
            'name' => $emotion->getName(),
        ];

        $translator = $this->getTranslation();
        $routerCampaignTemplate = Shopware()->Config()->get('routerCampaignTemplate');

        /** @var Shop $shop */
        foreach ($shops as $shop) {
            $seoIndexer->registerShop($shop->getId());
            $fallbackShopId = null;
            $fallbackShop = $shop->getFallback();
            if (!empty($fallbackShop)) {
                $fallbackShopId = $fallbackShop->getId();
            }
            // Make sure a template is available
            $module->baseSetup();
            $module->sCreateRewriteTableForSingleCampaign($translator, $shop->getId(), $fallbackShopId, $emotionData, $routerCampaignTemplate);
        }
    }

    /**
     * @param int $emotionId
     * @param int $shopId
     *
     * @return bool|string
     */
    private function getSeoUrlFromRouter($emotionId, $shopId)
    {
        $repository = Shopware()->Container()->get('models')->getRepository(Shop::class);
        /** @var Shop $shop */
        $shop = $repository->getActiveById($shopId);
        if (empty($shop)) {
            return false;
        }
        $parent = $shop;
        if ($shop->getFallback()) {
            $parent = $shop->getFallback();
        }
        $parent->registerResources();

        return $this->Front()->Router()->assemble([
            'controller' => 'campaign',
            'module' => 'frontend',
            'emotionId' => $emotionId,
            'fullPath' => true,
        ]);
    }

    /**
     * @param int $emotionId
     */
    private function removePreview($emotionId)
    {
        /** @var Emotion $previewEmotion */
        $previewEmotion = $this->findPreviewEmotion($emotionId);
        if (!$previewEmotion) {
            return;
        }

        $this->getManager()->remove($previewEmotion);
        $this->getManager()->flush($previewEmotion);
    }
}
