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

/**
 * Controller of the enlight script renderer plugin
 *
 * The Enlight_Controller_Plugins_ScriptRenderer_Bootstrap is a default plugin to render javascript files over the
 * controller. Used by the extjs application module.
 *
 * @category   Enlight
 * @package    Enlight_Extensions
 * @copyright  Copyright (c) 2011, shopware AG (http://www.shopware.de)
 * @license    http://enlight.de/license     New BSD License
 */
class Enlight_Controller_Plugins_ScriptRenderer_Bootstrap extends Enlight_Plugin_Bootstrap_Default
{
    /**
     * @var string Used when no file parameter is given.
     */
    protected $defaultFile = null;


    /**
     * @var array Will be set in the response instance on pre dispatch.
     */
    protected $headers = array(
        'Content-Type'  => null,
        'Cache-Control' => 'private, proxy-revalidate, max-age=2592000, s-maxage=0',
        'Pragma'        => 'private',
        'Expires'       => null,
        'Last-Modified' => null
    );

    /**
     * @var bool Flag if the view is already rendered
     */
    protected $render = false;

    /**
     * @var Enlight_Controller_Plugins_ViewRenderer_Bootstrap Instance of the enlight view renderer.
     */
    protected $viewRenderer;

    /**
     * Plugin install method.
     * Subscribes the Enlight_Controller_Action_PreDispatch event to
     * render the script template and set the headers in the response instance.
     */
    public function init()
    {
        $event = new Enlight_Event_Handler_Default(
            'Enlight_Controller_Action_PreDispatch',
            array($this, 'onPreDispatch'),
            300
        );
        $this->Application()->Events()->registerListener($event);
    }

    /**
     * Loads the script template, if not set.
     *
     * @param   Enlight_Event_EventArgs $args
     */
    public function onPreDispatch(Enlight_Event_EventArgs $args)
    {
        if (!$this->render) {
            return;
        }

        $this->render = false;

        if ($this->viewRenderer->Action()->View()->hasTemplate()
            || !$this->viewRenderer->shouldRender()
        ) {
            return;
        }

        $template = $this->getTemplateName();
        if ($template === null) {
            return;
        }

        $this->viewRenderer->Action()->View()->loadTemplate($template);

        foreach ($this->headers as $name => $value) {
            if ($name === 'Expires' && $value === null) {
                $value = Zend_Date::now()->addMonth(1)->get(Zend_Date::RFC_1123);
            } elseif ($name === 'Last-Modified' && $value === null) {
                $value = Zend_Date::now();
                $value = $value->get(Zend_Date::RFC_1123);
            } elseif ($name === 'Content-Type' && $value === null) {
                $front = $args->getSubject()->Front();
                $value = 'application/javascript; charset=' . $front->getParam('charset');
            }

            $this->viewRenderer->Action()->Response()->setHeader($name, $value, true);
        }
    }

    /**
     * Sets the render flag. Loads the view renderer.
     *
     * @param   bool $flag
     * @return  Enlight_Controller_Plugins_ScriptRenderer_Bootstrap
     */
    public function setRender($flag = true)
    {
        $this->setViewRenderer();
        $this->render = $flag ? true : false;
        return $this;
    }

    /**
     * Returns the template name.
     *
     * @return  string
     */
    public function getTemplateName()
    {
        $request = $this->viewRenderer->Action()->Request();
        $dispatcher = $this->viewRenderer->Front()->Dispatcher();

        $moduleName = $dispatcher->formatModuleName($request->getModuleName());
        $controllerName = $dispatcher->formatControllerName($request->getControllerName());

        $fileNames = (array) $request->getParam('file', $this->defaultFile);
        if (empty($fileNames)) {
            $fileNames = $request->getParam('f');
            $fileNames = explode('|', $fileNames);
        }

        $templateNames = array();
        foreach ($fileNames as $fileName) {
            // Remove unwanted characters
            $fileName = preg_replace('/[^a-z0-9\/_-]/i', '', $fileName);

            // Replace multiple forward slashes
            $fileName = preg_replace('#/+#', '/', $fileName);

            // Remove leading and trailing forward slash
            $fileName = trim($fileName, '/');

            // if string starts with "m/" replace with "model/"
            $fileName = preg_replace('/^m\//', 'model/', $fileName);
            $fileName = preg_replace('/^c\//', 'controller/', $fileName);
            $fileName = preg_replace('/^v\//', 'view/', $fileName);

            if (empty($fileName)) {
                continue;
            }

            $fileName = $this->inflectPath($moduleName, $controllerName, $fileName);

            $templateNames[]  = $fileName;
        }

        $count = count($templateNames);
        if ($count === 0) {
            return null;
        } elseif ($count === 1) {
            return $templateNames[0];
        } else {
            return 'snippet:string:{include file="' . implode("\"}\n{include file=\"", $templateNames) . '"}';
        }
    }

    /**
     * Sets the view renderer instance
     *
     * @param Enlight_Controller_Plugins_ViewRenderer_Bootstrap|null $viewRenderer
     * @return Enlight_Controller_Plugins_ScriptRenderer_Bootstrap
     */
    public function setViewRenderer(Enlight_Controller_Plugins_ViewRenderer_Bootstrap $viewRenderer = null)
    {
        if ($viewRenderer === null) {
            $viewRenderer = $this->Collection()->get('ViewRenderer');
        }

        $this->viewRenderer = $viewRenderer;

        return $this;
    }

    /**
     * @param string $module
     * @param string $controller
     * @param string $file
     * @return string
     */
    private function inflectPath($module, $controller, $file)
    {
        return sprintf(
            '%s/%s/%s.js',
            mb_strtolower($this->camelCaseToUnderScore($module)),
            mb_strtolower($this->camelCaseToUnderScore($controller)),
            mb_strtolower($this->camelCaseToUnderScore($file))
        );
    }

    /**
     * @param string $input
     * @return string
     */
    private function camelCaseToUnderScore($input)
    {
        $pattern = ['#(?<=(?:\p{Lu}))(\p{Lu}\p{Ll})#','#(?<=(?:\p{Ll}|\p{Nd}))(\p{Lu})#'];
        $replacement = ['_\1', '_\1'];

        return preg_replace($pattern, $replacement, $input);
    }
}
