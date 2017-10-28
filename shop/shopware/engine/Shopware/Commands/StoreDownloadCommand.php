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

namespace Shopware\Commands;

use Shopware\Bundle\PluginInstallerBundle\Context\DownloadRequest;
use Shopware\Bundle\PluginInstallerBundle\Context\LicenceRequest;
use Shopware\Bundle\PluginInstallerBundle\Context\PluginsByTechnicalNameRequest;
use Shopware\Bundle\PluginInstallerBundle\Exception\StoreException;
use Shopware\Bundle\PluginInstallerBundle\Service\PluginLicenceService;
use Shopware\Bundle\PluginInstallerBundle\Service\PluginStoreService;
use Shopware\Bundle\PluginInstallerBundle\StoreClient;
use Shopware\Bundle\PluginInstallerBundle\Struct\AccessTokenStruct;
use Shopware\Bundle\PluginInstallerBundle\Struct\LicenceStruct;
use Shopware\Bundle\PluginInstallerBundle\Struct\PluginStruct;
use Shopware\Models\Plugin\Plugin;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class StoreDownloadCommand extends StoreCommand
{
    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sw:store:download')
            ->setDescription('Downloads a plugin from the community store')
            ->addArgument('technical-name', InputArgument::REQUIRED, 'Name of the plugin to be downloaded.')
            ->addOption('username', null, InputOption::VALUE_REQUIRED)
            ->addOption('password', null, InputOption::VALUE_REQUIRED)
            ->addOption('shopware-version', null, InputOption::VALUE_REQUIRED, 'Override shopware version eg. 5.2.0')
            ->addOption('domain', null, InputOption::VALUE_REQUIRED, 'Override default shop domain.')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $technicalName = $input->getArgument('technical-name');
        $domain = $this->checkDomain();
        $version = $this->checkVersion();
        $token = null;

        $io = $this->io = new SymfonyStyle($input, $output);
        $io->title('Community Store Download Command');

        $plugin = $this->getFreePlugin($technicalName, $version);

        if ($plugin && $plugin->getCode() !== null) {
            if ($plugin->hasFreeDownload() === false && $plugin->hasCapabilityDummy() === false) {
                $io->note(sprintf('You must be authenticated to download: %s', $plugin->getLabel()));

                $token = $this->checkAuthentication();
            }
        } else {
            $io->note('Plugin was not found. Retrying as authenticated used.');

            $token = $this->checkAuthentication();

            if ($token) {
                $context = new LicenceRequest(null, $version, $domain, $token);

                try {
                    /** @var PluginStoreService $pluginStoreService */
                    $pluginStoreService = $this->container->get(
                        'shopware_plugininstaller.plugin_service_store_production'
                    );
                    $licences = $pluginStoreService->getLicences($context);
                    $licences = array_filter(
                        $licences,
                        function (LicenceStruct $license) use ($technicalName) {
                            return strtolower($license->getTechnicalName()) === strtolower($technicalName);
                        }
                    );

                    /** @var LicenceStruct $plugin */
                    $plugin = array_shift($licences);
                } catch (\Exception $e) {
                    $io->error('An error occured: ' . $e->getMessage());
                    exit(1);
                }
            }
        }

        if (!$plugin) {
            $io->error(sprintf('Plugin %s not found', $technicalName));

            return;
        }

        $io->section($plugin->getLabel());
        $io->comment(sprintf('Checking system requirements for plugin %s', $plugin->getLabel()));

        $plugin = $this->createPluginStruct($plugin);

        $this->checkLicenceManager($plugin);
        $this->checkIonCubeLoader($plugin);

        $isDummy = ($plugin->hasCapabilityDummy() || $plugin->getTechnicalName() === 'SwagLicense');

        try {
            switch (true) {
                case $plugin->getId() && $isDummy:
                    $this->handleDummyUpdate($plugin, $domain, $version);
                    break;

                case $isDummy:
                    $this->handleDummyInstall($plugin, $domain, $version);
                    break;

                case $plugin->getId():
                    $this->handleLicenceUpdate($plugin, $domain, $version, $token);
                    break;

                default:
                    $this->handleLicenceInstall($plugin, $domain, $version, $token);
                    break;
            }
        } catch (\Exception $e) {
            $io->error('An error occured: ' . $e->getMessage());
            exit(1);
        }

        try {
            $this->clearOpcodeCache();
            $this->container->get('shopware_plugininstaller.plugin_manager')->refreshPluginList();

            $this->io->success('Process completed successfully.');
        } catch (\Exception $e) {
        }
    }

    /**
     * @param PluginStruct $plugin
     * @param string       $domain
     * @param string       $version
     *
     * @throws \Exception
     */
    private function handleDummyUpdate(PluginStruct $plugin, $domain, $version)
    {
        if (!$plugin->isUpdateAvailable()) {
            $this->io->text(sprintf('No update available for plugin %s', $plugin->getLabel()));

            return;
        }

        $this->io->comment(sprintf('Download plugin update package %s', $plugin->getLabel()));

        $request = new DownloadRequest($plugin->getTechnicalName(), $version, $domain, null);

        $model = $this->getPluginModel($plugin->getTechnicalName());
        if ($plugin->isActive()) {
            $this->container->get('shopware_plugininstaller.plugin_manager')->deactivatePlugin($model);
        }

        $this->container->get('shopware_plugininstaller.plugin_download_service')
            ->download($request);
    }

    /**
     * @param PluginStruct $plugin
     * @param string       $version
     * @param $domain
     *
     * @throws \Exception
     */
    private function handleDummyInstall(PluginStruct $plugin, $domain, $version)
    {
        $this->io->comment(sprintf('Download plugin install package %s', $plugin->getLabel()));

        $request = new DownloadRequest($plugin->getTechnicalName(), $version, $domain, null);

        $this->container->get('shopware_plugininstaller.plugin_download_service')->download($request);
    }

    /**
     * @param PluginStruct      $plugin
     * @param string            $domain
     * @param string            $version
     * @param AccessTokenStruct $token
     *
     * @throws \Exception
     */
    private function handleLicenceUpdate(PluginStruct $plugin, $domain, $version, AccessTokenStruct $token = null)
    {
        if (!$plugin->isUpdateAvailable()) {
            $this->io->text(sprintf('No update available for plugin %s', $plugin->getLabel()));

            return;
        }

        $this->io->comment('Downloading plugin update package');

        $model = $this->getPluginModel($plugin->getTechnicalName());
        if ($plugin->isActive()) {
            $this->container->get('shopware_plugininstaller.plugin_manager')
                ->deactivatePlugin($model);
        }

        $request = new DownloadRequest($plugin->getTechnicalName(), $version, $domain, $token);
        $this->container->get('shopware_plugininstaller.plugin_download_service')
            ->download($request);
    }

    /**
     * @param PluginStruct      $plugin
     * @param string            $domain
     * @param string            $version
     * @param AccessTokenStruct $token
     *
     * @throws \Exception
     */
    private function handleLicenceInstall(PluginStruct $plugin, $domain, $version, AccessTokenStruct $token = null)
    {
        $this->io->comment('Downloading plugin install package');

        $request = new DownloadRequest($plugin->getTechnicalName(), $version, $domain, $token);

        /* @var $service PluginLicenceService */
        $this->container->get('shopware_plugininstaller.plugin_download_service')->download($request);
    }

    /**
     * @return bool
     */
    private function isIonCubeLoaderLoaded()
    {
        return extension_loaded('ionCube Loader');
    }

    /**
     * @param $technicalName
     *
     * @return Plugin|null
     */
    private function getPluginModel($technicalName)
    {
        $repo = $this->container->get('models')->getRepository(Plugin::class);

        return $repo->findOneBy(['name' => $technicalName]);
    }

    private function checkDomain()
    {
        $domain = $this->input->getOption('domain');
        if (empty($domain)) {
            $domain = $this->container->get('shopware_plugininstaller.account_manager_service')->getDomain();
        }

        return $domain;
    }

    private function checkVersion()
    {
        $version = $this->input->getOption('shopware-version');
        if (empty($version)) {
            $version = \Shopware::VERSION;
        }

        return $version;
    }

    /**
     * @param PluginStruct $struct
     *
     * @throws \Exception
     */
    private function checkLicenceManager(PluginStruct $struct)
    {
        if (!$struct->hasLicenceCheck()) {
            return;
        }

        $repo = $this->container->get('models')->getRepository(Plugin::class);

        /** @var Plugin $plugin */
        $plugin = $repo->findOneBy(['name' => 'SwagLicense']);

        switch (true) {
            case !$plugin instanceof Plugin:
                $this->handleError(['message' => sprintf("Plugin %s contains a licence check and the licence manager doesn't exist in your system.", $struct->getLabel())]);
                break;
            case $plugin->getInstalled() === null:
                $this->handleError(['message' => sprintf('Plugin %s contains a licence check and the licence manager is not installed', $struct->getLabel())]);
                break;
            case !$plugin->getActive():
                $this->handleError(['message' => sprintf("Plugin %s contains a licence check and the licence manager isn't activated", $struct->getLabel())]);
                break;
        }
    }

    /**
     * @param PluginStruct $plugin
     *
     * @throws \Exception
     */
    private function checkIonCubeLoader(PluginStruct $plugin)
    {
        if (!$plugin->isEncrypted()) {
            return;
        }

        if ($this->isIonCubeLoaderLoaded()) {
            return;
        }

        $this->handleError([
            'message' => sprintf('Plugin %s is encrypted and requires the ioncube loader extension', $plugin->getLabel()),
        ]);
    }

    /**
     * @throws \Exception
     *
     * @return AccessTokenStruct
     */
    private function checkAuthentication()
    {
        $username = $this->input->getOption('username');
        $password = $this->input->getOption('password');

        if ($this->input->isInteractive()) {
            if (empty($username)) {
                $username = $this->io->ask('ShopwareId');
            }

            if (empty($password)) {
                $password = $this->io->askHidden('Password');
            }
        }

        try {
            $this->io->section('Community Store Authentication');
            $this->io->comment('Connection to store...');

            /** @var StoreClient $storeClient */
            $storeClient = $this->container->get('shopware_plugininstaller.store_client');
            $token = $storeClient->getAccessToken($username, $password);

            $this->io->comment('Authenticated successfully.');
        } catch (StoreException $e) {
            $this->io->error('Login failed. Please check your credentials.');
            exit(1);
        }

        return $token;
    }

    /**
     * Clear opcode caches to make sure that the
     * updated plugin files are used in the following requests.
     */
    private function clearOpcodeCache()
    {
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        if (function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
    }

    /**
     * @param $plugin
     *
     * @return PluginStruct
     */
    private function createPluginStruct($plugin)
    {
        if ($plugin instanceof PluginStruct) {
            return $plugin;
        }

        if ($plugin instanceof LicenceStruct) {
            $struct = new PluginStruct($plugin->getTechnicalName());

            $struct->setLabel($plugin->getLabel());
            $struct->setLicenceCheck($plugin->isLicenseCheckEnabled());
            $struct->setAvailableVersion($plugin->getBinaryVersion());

            $localPlugin = $this->getPluginModel($plugin->getTechnicalName());

            if ($localPlugin) {
                $struct->setId($localPlugin->getId());

                preg_match('/(\d\.\d\.\d)/', $localPlugin->getVersion(), $matches);

                $localVersion = array_shift($matches);
                if ($localVersion) {
                    $updateAvailable = version_compare($plugin->getBinaryVersion(), $localVersion);

                    $struct->setUpdateAvailable($updateAvailable === 1);
                    $struct->setVersion($localVersion);
                }
            }

            return $struct;
        }

        throw new \RuntimeException('Unknown plugin source: ' . get_class($plugin));
    }

    /**
     * @param string $technicalName
     * @param string $version
     *
     * @return PluginStruct|null
     */
    private function getFreePlugin($technicalName, $version)
    {
        $this->io->comment('Searching for plugin: ' . $technicalName);

        $service = $this->container->get('shopware_plugininstaller.plugin_service_view');
        $context = new PluginsByTechnicalNameRequest(null, $version, [$technicalName]);

        return $service->getPlugin($context);
    }
}
