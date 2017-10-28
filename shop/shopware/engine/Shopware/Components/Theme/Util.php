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

namespace Shopware\Components\Theme;

use Doctrine\ORM\AbstractQuery;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Theme;
use Shopware\Models\Shop as Shop;

/**
 * The Theme\Util class is a helper class
 * which contains different small functions
 * which used in all other Theme\* classes.
 *
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Util
{
    /**
     * Required for different path operations.
     *
     * @var PathResolver
     */
    private $pathResolver;

    /**
     * Only used to get all active plugins.
     *
     * @var ModelManager
     */
    private $entityManager;

    /**
     * Class constructor which injects all dependencies.
     *
     * @param ModelManager $entityManager
     * @param PathResolver $pathResolver
     */
    public function __construct(ModelManager $entityManager, PathResolver $pathResolver)
    {
        $this->entityManager = $entityManager;
        $this->pathResolver = $pathResolver;
    }

    /**
     * Returns the preview image of the passed shopware template.
     * The image will be encoded as base 64 image.
     *
     * @param Shop\Template $template
     *
     * @return null|string
     */
    public function getPreviewImage(Shop\Template $template)
    {
        return $this->getThemeImage($template);
    }

    /**
     * Helper function which returns the Theme.php instance
     * of the passed shopware template.
     * The function resolves the theme directory over the
     * getDirectory function of the PathResolver
     *
     * @param Shop\Template $template
     *
     * @throws \Exception
     *
     * @return Theme
     */
    public function getThemeByTemplate(Shop\Template $template)
    {
        $namespace = 'Shopware\\Themes\\' . $template->getTemplate();
        $class = $namespace . '\\Theme';

        $directory = $this->pathResolver->getDirectory($template);

        $file = $directory . DIRECTORY_SEPARATOR . 'Theme.php';

        if (!file_exists($file)) {
            throw new \Exception(sprintf(
                'Theme directory %s contains no Theme.php',
                $template->getTemplate()
            ));
        }

        require_once $file;

        return new $class();
    }

    /**
     * Resolves the passed directory to a theme class.
     * Returns a new instance of the \Shopware\Theme
     *
     * @param \DirectoryIterator $directory
     *
     * @throws \Exception
     *
     * @return Theme
     */
    public function getThemeByDirectory(\DirectoryIterator $directory)
    {
        $namespace = 'Shopware\\Themes\\' . $directory->getFilename();
        $class = $namespace . '\\Theme';

        $file = $directory->getPathname() . DIRECTORY_SEPARATOR . 'Theme.php';

        if (!file_exists($file)) {
            throw new \Exception(sprintf(
                'Theme directory %s contains no Theme.php',
                $directory->getFilename()
            ));
        }

        require_once $file;

        if (!class_exists($class)) {
            throw new \Exception(sprintf(
                'Theme file %s contains unexpected class %s',
                $file,
                $class
            ));
        }

        return new $class();
    }

    /**
     * Returns the snippet namespace for the passed theme.
     *
     * @param Shop\Template $template
     *
     * @return string
     */
    public function getSnippetNamespace(Shop\Template $template)
    {
        return 'themes/' . strtolower($template->getTemplate()) . '/';
    }

    /**
     * Returns an object list with all installed and activated plugins.
     *
     * @return array
     */
    public function getActivePlugins()
    {
        $builder = $this->entityManager->createQueryBuilder();

        $builder->select(['plugins'])
            ->from('Shopware\Models\Plugin\Plugin', 'plugins')
            ->where('plugins.active = true')
            ->andWhere('plugins.installed IS NOT NULL');

        return $builder->getQuery()->getResult(
            AbstractQuery::HYDRATE_OBJECT
        );
    }

    /**
     * Returns the theme preview thumbnail.
     *
     * @param \Shopware\Models\Shop\Template $theme
     *
     * @return null|string
     */
    private function getThemeImage(Shop\Template $theme)
    {
        $directory = $this->pathResolver->getDirectory($theme);

        $thumbnail = $directory . '/preview.png';

        if (!file_exists($thumbnail)) {
            return null;
        }

        $thumbnail = file_get_contents($thumbnail);

        return 'data:image/png;base64,' . base64_encode($thumbnail);
    }
}
