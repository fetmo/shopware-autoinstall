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
use Shopware\Bundle\AttributeBundle\Service\CrudService;

/**
 * Shopware Translation Component
 */
class Shopware_Components_Translation
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection|null $connection
     */
    public function __construct(Connection $connection = null)
    {
        $this->connection = $connection ?: Shopware()->Container()->get('dbal_connection');
    }

    /**
     * Filter translation data for saving.
     *
     * @param string $type
     * @param array  $data
     * @param null   $key
     *
     * @return string
     */
    public function filterData($type, array $data, $key = null)
    {
        $map = $this->getMapping($type);
        $tmp = $key ? $data[$key] : $data;

        if ($map !== false) {
            foreach (array_flip($map) as $from => $to) {
                if (isset($tmp[$from])) {
                    $tmp[$to] = $tmp[$from];
                    unset($tmp[$from]);
                }
            }
        }
        foreach ($tmp as $tmpKey => $value) {
            if (!is_string($value)) {
                continue;
            }
            if ('' === trim($value)) {
                unset($tmp[$tmpKey]);
            }
        }

        if ($key) {
            $data[$key] = $tmp;
        } else {
            $data = $tmp;
        }

        return serialize($data);
    }

    /**
     * Un filter translation data for output.
     *
     * @param string $type
     * @param mixed  $data
     * @param null   $key
     *
     * @return array
     */
    public function unFilterData($type, $data, $key = null)
    {
        $tmp = unserialize($data);
        if ($tmp === false) {
            $tmp = unserialize(utf8_decode($data));
        }
        if ($tmp === false) {
            return [];
        }
        if ($key !== null) {
            $tmp = $tmp[$key];
        }
        $map = $this->getMapping($type);
        if ($map === false) {
            return $tmp;
        }
        foreach ($map as $from => $to) {
            if (isset($tmp[$from])) {
                $tmp[$to] = $tmp[$from];
                unset($tmp[$from]);
            }
        }

        return $tmp;
    }

    /**
     * Reads a single translation data from the storage.
     *
     * @param int    $language
     * @param string $type
     * @param int    $key
     * @param bool   $merge
     *
     * @return array
     */
    public function read($language, $type, $key = 1, $merge = false)
    {
        if ($type === 'variantMain') {
            $type = 'article';
        }

        $query = $this->connection->createQueryBuilder()
            ->select('`objectdata`')
            ->from('`s_core_translations`')
            ->where('`objecttype` = :type')
            ->andWhere('`objectkey` = :key')
            ->andWhere('`objectlanguage` = :language')
            ->setParameter(':type', $type)
            ->setParameter(':key', $merge ? 1 : $key)
            ->setParameter(':language', $language);

        $data = $query->execute()
            ->fetch(\PDO::FETCH_COLUMN);

        return $this->unFilterData($type, $data, $merge ? $key : null);
    }

    /**
     * Reads a single translation data from the storage.
     * Also loads fallback (has less priority)
     *
     * @param int    $language
     * @param string $fallback
     * @param string $type
     * @param int    $key
     * @param bool   $merge
     *
     * @return array
     */
    public function readWithFallback($language, $fallback, $type, $key = 1, $merge = false)
    {
        $translation = $this->read($language, $type, $key, $merge);
        if ($fallback) {
            $translationFallback = $this->read($fallback, $type, $key, $merge);
        } else {
            $translationFallback = [];
        }

        return $translation + $translationFallback;
    }

    /**
     * Reads multiple translation data from storage.
     *
     * @param int    $language
     * @param string $type
     * @param int    $key
     * @param bool   $merge
     *
     * @return array
     */
    public function readBatch($language, $type, $key = 1, $merge = false)
    {
        if ($type === 'variantMain') {
            $type = 'article';
        }

        $queryBuilder = $this->connection->createQueryBuilder()
            ->select('objectdata, objectlanguage, objecttype, objectkey')
            ->from('s_core_translations', 't');

        if ($language) {
            $queryBuilder
                ->andWhere('t.objectlanguage = :objectLanguage')
                ->setParameter('objectLanguage', $language);
        }
        if ($type) {
            $queryBuilder
                ->andWhere('t.objecttype = :objectType')
                ->setParameter('objectType', $type);
        }
        if ($key) {
            $queryBuilder
                ->andWhere('t.objectkey = :objectKey')
                ->setParameter('objectKey', $merge ? 1 : $key);
        }

        $data = $queryBuilder->execute()->fetchAll();

        foreach ($data as &$translation) {
            $translation['objectdata'] = $this->unFilterData(
                $translation['objecttype'],
                $translation['objectdata'],
                null
            );

            if ($merge) {
                return $translation['objectdata'];
            }
        }

        return $data;
    }

    /**
     * Reads multiple translations including their fallbacks
     * Merges the two (fallback has less priority) and returns the results
     *
     * @param int $language
     * @param int $fallback
     * @param $type
     *
     * @return array|mixed
     */
    public function readBatchWithFallback($language, $fallback, $type)
    {
        $translationData = $this->readBatch($language, $type, 1, true);

        // Look for a fallback and correspondent translations
        if (!empty($fallback)) {
            $translationFallback = $this->readBatch($fallback, $type, 1, true);

            if (!empty($translationFallback)) {
                // We need something like array_merge_recursive, but that also
                // recursively merges elements with int keys.
                foreach ($translationFallback as $key => $data) {
                    if (array_key_exists($key, $translationData)) {
                        $translationData[$key] += $data;
                    } else {
                        $translationData[$key] = $data;
                    }
                }
            }
        }

        return $translationData;
    }

    /**
     * Deletes translations from storage.
     *
     * @param int    $language
     * @param string $type
     * @param int    $key
     *
     * @return array
     */
    public function delete($language, $type, $key = 1)
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->delete('s_core_translations');

        if ($language) {
            $queryBuilder
                ->andWhere('objectlanguage = :objectLanguage')
                ->setParameter('objectLanguage', $language);
        }
        if ($type) {
            $queryBuilder
                ->andWhere('objecttype = :objectType')
                ->setParameter('objectType', $type);
        }
        if ($key) {
            $queryBuilder
                ->andWhere('objectkey = :objectKey')
                ->setParameter('objectKey', $key);
        }

        $queryBuilder->execute();
    }

    /**
     * Writes multiple translation data to storage.
     *
     * @param mixed $data
     * @param bool  $merge
     *
     * @throws \Zend_Db_Adapter_Exception
     */
    public function writeBatch($data, $merge = false)
    {
        $requiredKeys = ['objectdata', 'objectlanguage', 'objecttype', 'objectkey'];

        foreach ($data as $translation) {
            if (count(array_intersect_key(array_flip($requiredKeys), $translation)) !== count($requiredKeys)) {
                continue;
            }

            $this->write(
                $translation['objectlanguage'],
                $translation['objecttype'],
                $translation['objectkey'] ?: 1,
                $translation['objectdata'],
                $merge
            );
        }
    }

    /**
     * Saves translation data to the storage.
     *
     * @param int    $language
     * @param string $type
     * @param int    $key
     * @param mixed  $data
     * @param bool   $merge
     *
     * @throws \Zend_Db_Adapter_Exception
     *
     * @return int|bool
     */
    public function write($language, $type, $key = 1, $data = null, $merge = false)
    {
        if ($type === 'variantMain') {
            $type = 'article';
            $data = array_merge(
                $this->read($language, $type, $key),
                $data
            );
        }

        if ($merge) {
            $tmp = $this->read($language, $type, 1);
            $tmp[$key] = $data;
            $data = $tmp;
        }

        $data = $this->filterData($type, $data, $merge ? $key : null);

        if (!empty($data)) {
            $sql = '
                INSERT INTO `s_core_translations` (
                  `objecttype`, `objectdata`, `objectkey`, `objectlanguage`, `dirty`
                ) VALUES (
                  :type, :data, :key, :language, 1
                ) ON DUPLICATE KEY UPDATE `objectdata`=VALUES(`objectdata`), `dirty` = 1;
            ';
            $this->connection->executeQuery(
                $sql,
                [
                    ':type' => $type,
                    ':data' => $data,
                    ':key' => $merge ? 1 : $key,
                    ':language' => $language,
                ]
            );
        } else {
            $sql = '
                DELETE FROM `s_core_translations`
                WHERE `objecttype`= :type
                AND `objectkey`= :key
                AND `objectlanguage`= :language
            ';
            $this->connection->executeQuery(
                $sql,
                [
                    ':type' => $type,
                    ':key' => $merge ? 1 : $key,
                    ':language' => $language,
                ]
            );
        }
        if ($type === 'article') {
            $this->fixArticleTranslation($language, $key, $data);
        }
    }

    /**
     * Filter translation text method
     *
     * @param string $text
     *
     * @return string
     */
    protected function filterText($text)
    {
        $text = html_entity_decode($text);
        $text = preg_replace('!<[^>]*?>!', ' ', $text);
        $text = str_replace(chr(0xa0), ' ', $text);
        $text = preg_replace('/\s\s+/', ' ', $text);
        $text = htmlspecialchars($text);
        $text = trim($text);

        return $text;
    }

    /**
     * Returns mapping for a translation type
     *
     * @param $type
     *
     * @return array|bool
     */
    protected function getMapping($type)
    {
        switch ($type) {
            case 'article':
                return [
                    'txtArtikel' => 'name',
                    'txtshortdescription' => 'description',
                    'txtlangbeschreibung' => 'descriptionLong',
                    'txtzusatztxt' => 'additionalText',
                    'txtkeywords' => 'keywords',
                    'txtpackunit' => 'packUnit',
                ];
            case 'variant':
                return [
                    'txtzusatztxt' => 'additionalText',
                    'txtpackunit' => 'packUnit',
                ];
            case 'link':
                return [
                    'linkname' => 'description',
                ];
            case 'download':
                return [
                    'downloadname' => 'description',
                ];
            case 'config_countries':
                return [
                    'countryname' => 'name',
                    'notice' => 'description',
                ];
            case 'config_units':
                return [
                    'description' => 'name',
                ];
            case 'config_dispatch':
                return [
                    'dispatch_name' => 'name',
                    'dispatch_description' => 'description',
                    'dispatch_status_link' => 'statusLink',
                ];
            default:
                return false;
        }
    }

    /**
     * Fix article translation table data.
     *
     * @param int    $languageId
     * @param int    $articleId
     * @param string $data
     *
     * @throws \Exception
     */
    protected function fixArticleTranslation($languageId, $articleId, $data)
    {
        $fallbacks = $this->connection->fetchAll(
            'SELECT id FROM s_core_shops WHERE fallback_id = :languageId',
            [':languageId' => $languageId]
        );
        $fallbacks = array_column($fallbacks, 'id');

        $data = $this->prepareArticleData($data);
        $this->addArticleTranslation($articleId, $languageId, $data);

        $existQuery = $this->connection->prepare(
            "SELECT 1
             FROM s_core_translations
             WHERE objectlanguage = :language
             AND objecttype = 'article'
             AND objectkey = :articleId LIMIT 1"
        );

        foreach ($fallbacks as $id) {
            //check if fallback ids contains an individual translation
            $existQuery->execute([':language' => $id, ':articleId' => $articleId]);
            $exist = $existQuery->fetch(PDO::FETCH_COLUMN);

            //if shop translation of fallback exists, skip
            if ($exist) {
                continue;
            }
            //add fallback translation to s_articles_translation for search requests.
            $this->addArticleTranslation($articleId, $id, $data);
        }
    }

    /**
     * @param string $data
     *
     * @return array
     */
    private function prepareArticleData($data)
    {
        $data = unserialize($data);
        if (!empty($data['txtlangbeschreibung']) && strlen($data['txtlangbeschreibung']) > 1000) {
            $data['txtlangbeschreibung'] = substr(strip_tags($data['txtlangbeschreibung']), 0, 1000);
        }

        $data = array_merge($data, [
            'name' => (isset($data['txtArtikel'])) ? (string) $data['txtArtikel'] : '',
            'keywords' => (isset($data['txtkeywords'])) ? (string) $data['txtkeywords'] : '',
            'description' => (isset($data['txtshortdescription'])) ? (string) $data['txtshortdescription'] : '',
            'description_long' => (isset($data['txtlangbeschreibung'])) ? (string) $data['txtlangbeschreibung'] : '',
        ]);

        $schemaManager = $this->connection->getSchemaManager();
        $columns = $schemaManager->listTableColumns('s_articles_translations');
        $columns = array_keys($columns);

        foreach ($data as $key => $value) {
            $column = strtolower($key);
            $column = str_replace(CrudService::EXT_JS_PREFIX, '', $column);

            unset($data[$key]);
            if (in_array($column, $columns)) {
                $data[$column] = $value;
            }
        }

        return $data;
    }

    /**
     * @param int   $articleId
     * @param int   $languageId
     * @param array $data
     *
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     */
    private function addArticleTranslation($articleId, $languageId, array $data)
    {
        $query = $this->connection->executeQuery(
            'SELECT id FROM s_articles_translations WHERE articleID = :articleId AND languageID = :languageId LIMIT 1',
            [':articleId' => $articleId, ':languageId' => $languageId]
        );
        $exist = $query->fetch(PDO::FETCH_COLUMN);

        if ($exist) {
            $this->updateArticleTranslation($exist, $data);
        } else {
            $this->insertArticleTranslation($articleId, $languageId, $data);
        }
    }

    /**
     * @param int   $articleId
     * @param int   $languageId
     * @param array $data
     *
     * @throws \Exception
     */
    private function insertArticleTranslation($articleId, $languageId, array $data)
    {
        $data = array_merge($data, ['languageID' => $languageId, 'articleID' => $articleId]);

        $query = $this->connection->createQueryBuilder();
        $query->insert('s_articles_translations');
        foreach ($data as $key => $value) {
            $query->setValue($key, ':' . $key);
            $query->setParameter(':' . $key, $value);
        }
        $query->execute();
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @throws \Exception
     */
    private function updateArticleTranslation($id, array $data)
    {
        $query = $this->connection->createQueryBuilder();

        $query->update('s_articles_translations', 'translation');
        foreach ($data as $key => $value) {
            $query->set($key, ':' . $key);
            $query->setParameter(':' . $key, $value);
        }

        $query->where('id = :id');
        $query->setParameter(':id', $id);
        $query->execute();
    }
}
