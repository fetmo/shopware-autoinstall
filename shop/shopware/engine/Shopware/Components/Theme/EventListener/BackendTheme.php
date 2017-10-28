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

namespace Shopware\Components\Theme\EventListener;

use Shopware\Components\DependencyInjection\Container;

/**
 * Registers the current backend theme for the backend requests.
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class BackendTheme
{
    /**
     * @var \Shopware\Components\DependencyInjection\Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Shopware\EventListener: Enlight_Controller_Front_RouteShutdown
     *
     * @param \Enlight_Controller_EventArgs $args
     */
    public function registerBackendTheme(\Enlight_Controller_EventArgs $args)
    {
        if ($args->getRequest()->getModuleName() != 'backend') {
            return;
        }

        $directory = $this->container->get('theme_path_resolver')->getExtJsThemeDirectory();

        $this->container->get('template')->setTemplateDir([
            'backend' => $directory,
            'include_dir' => '.',
        ]);
    }
}
