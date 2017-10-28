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

namespace Shopware\Bundle\ESIndexingBundle;

use Elasticsearch\Client;
use Shopware\Bundle\ESIndexingBundle\Console\ProgressHelperInterface;
use Shopware\Bundle\ESIndexingBundle\Struct\IndexConfiguration;
use Shopware\Bundle\ESIndexingBundle\Struct\ShopIndex;
use Shopware\Bundle\StoreFrontBundle\Struct\Shop;

class ShopIndexer implements ShopIndexerInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var BacklogReaderInterface
     */
    private $backlogReader;

    /**
     * @var MappingInterface[]
     */
    private $mappings;

    /**
     * @var DataIndexerInterface[]
     */
    private $indexer;

    /**
     * @var SettingsInterface[]
     */
    private $settings;

    /**
     * @var IndexFactoryInterface
     */
    private $indexFactory;

    /**
     * @var BacklogProcessorInterface
     */
    private $backlogProcessor;

    /**
     * @var array
     */
    private $configuration;

    /**
     * @param Client                    $client
     * @param BacklogReaderInterface    $backlogReader
     * @param BacklogProcessorInterface $backlogProcessor
     * @param IndexFactoryInterface     $indexFactory
     * @param DataIndexerInterface[]    $indexer
     * @param MappingInterface[]        $mappings
     * @param SettingsInterface[]       $settings
     * @param array                     $configuration
     */
    public function __construct(
        Client $client,
        BacklogReaderInterface $backlogReader,
        BacklogProcessorInterface $backlogProcessor,
        IndexFactoryInterface $indexFactory,
        array $indexer,
        array $mappings,
        array $settings,
        array $configuration
    ) {
        $this->client = $client;
        $this->backlogReader = $backlogReader;
        $this->backlogProcessor = $backlogProcessor;
        $this->indexFactory = $indexFactory;
        $this->indexer = $indexer;
        $this->mappings = $mappings;
        $this->settings = $settings;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException
     */
    public function index(Shop $shop, ProgressHelperInterface $helper)
    {
        $lastBacklogId = $this->backlogReader->getLastBacklogId();
        $configuration = $this->indexFactory->createIndexConfiguration($shop);
        $shopIndex = new ShopIndex($configuration->getName(), $shop);

        $this->createIndex($configuration, $shopIndex);
        $this->updateMapping($shopIndex);
        $this->populate($shopIndex, $helper);
        $this->applyBacklog($shopIndex, $lastBacklogId);
        $this->createAlias($configuration);
    }

    /**
     * Removes unused indices
     */
    public function cleanupIndices()
    {
        $prefix = $this->indexFactory->getPrefix();
        $aliases = $this->client->indices()->getAliases();
        foreach ($aliases as $index => $indexAliases) {
            if (strpos($index, $prefix) !== 0) {
                continue;
            }

            if (empty($indexAliases['aliases'])) {
                $this->client->indices()->delete(['index' => $index]);
            }
        }
    }

    /**
     * @param IndexConfiguration $configuration
     * @param ShopIndex          $index
     *
     * @throws \RuntimeException
     */
    private function createIndex(IndexConfiguration $configuration, ShopIndex $index)
    {
        $exist = $this->client->indices()->exists(['index' => $configuration->getName()]);
        if ($exist) {
            throw new \RuntimeException(sprintf('ElasticSearch index %s already exist.', $configuration->getName()));
        }

        $mergedSettings = [
            'settings' => [
                'number_of_shards' => $configuration->getNumberOfShards(),
                'number_of_replicas' => $configuration->getNumberOfReplicas(),
            ],
        ];

        // Merge default settings with those set by plugins
        foreach ($this->settings as $setting) {
            $settings = $setting->get($index->getShop());
            if (!$settings) {
                continue;
            }

            $mergedSettings = array_replace_recursive($mergedSettings, $settings);
        }

        $this->client->indices()->create([
            'index' => $configuration->getName(),
            'body' => $mergedSettings,
        ]);
    }

    /**
     * @param ShopIndex $index
     */
    private function updateMapping(ShopIndex $index)
    {
        foreach ($this->mappings as $mapping) {
            $this->client->indices()->putMapping([
                'index' => $index->getName(),
                'type' => $mapping->getType(),
                'body' => $mapping->get($index->getShop()),
            ]);
        }
    }

    /**
     * @param ShopIndex               $index
     * @param ProgressHelperInterface $progress
     */
    private function populate(ShopIndex $index, ProgressHelperInterface $progress)
    {
        foreach ($this->indexer as $indexer) {
            $indexer->populate($index, $progress);
        }
        $this->client->indices()->refresh(['index' => $index->getName()]);
    }

    /**
     * @param ShopIndex $shopIndex
     * @param int       $lastId
     */
    private function applyBacklog(ShopIndex $shopIndex, $lastId)
    {
        $backlogs = $this->backlogReader->read($lastId, 100);

        if (empty($backlogs)) {
            return;
        }

        while ($backlogs = $this->backlogReader->read($lastId, 100)) {
            $this->backlogProcessor->process($shopIndex, $backlogs);
            $last = array_pop($backlogs);
            $lastId = $last->getId();
        }
    }

    /**
     * @param IndexConfiguration $configuration
     */
    private function createAlias(IndexConfiguration $configuration)
    {
        $exist = $this->client->indices()->existsAlias(['name' => $configuration->getAlias()]);

        if ($exist) {
            $this->switchAlias($configuration);

            return;
        }

        $this->client->indices()->putAlias([
            'index' => $configuration->getName(),
            'name' => $configuration->getAlias(),
        ]);
    }

    /**
     * @param IndexConfiguration $configuration
     */
    private function switchAlias(IndexConfiguration $configuration)
    {
        $actions = [
            ['add' => ['index' => $configuration->getName(), 'alias' => $configuration->getAlias()]],
        ];

        $current = $this->client->indices()->getAlias(['name' => $configuration->getAlias()]);
        $current = array_keys($current);

        foreach ($current as $value) {
            $actions[] = ['remove' => ['index' => $value, 'alias' => $configuration->getAlias()]];
        }
        $this->client->indices()->updateAliases(['body' => ['actions' => $actions]]);
    }
}
