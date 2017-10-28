<?php
/**
 * Enlight
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://enlight.de/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@shopware.de so we can send you a copy immediately.
 *
 * @category   Enlight
 * @package    Enlight_Hook
 * @copyright  Copyright (c) 2011, shopware AG (http://www.shopware.de)
 * @license    http://enlight.de/license     New BSD License
 * @version    $Id$
 * @author     Heiner Lohaus
 * @author     $Author$
 */

use ProxyManager\Generator\ClassGenerator;
use ProxyManager\Generator\MethodGenerator;
use ProxyManager\Generator\Util\ClassGeneratorUtils;
use ProxyManager\ProxyGenerator\Assertion\CanProxyAssertion;
use Zend\Code\Reflection\MethodReflection;

/**
 * The Enlight_Hook_ProxyFactory is the factory for the class proxies.
 *
 * If a class is hooked, a proxy will be generated for this class.
 * The generated class extends the origin class and implements the Enlight_Hook interface.
 * Instead of the origin methods, the registered hook handler methods are executed.
 *
 * @category   Enlight
 * @package    Enlight_Hook
 * @copyright  Copyright (c) 2011, shopware AG (http://www.shopware.de)
 * @license    http://enlight.de/license     New BSD License
 */
class Enlight_Hook_ProxyFactory extends Enlight_Class
{
    /**
     * @var Enlight_Hook_HookManager
     */
    protected $hookManager;

    /**
     * @var null|string namespace of the proxy
     */
    protected $proxyNamespace;

    /**
     * @var string directory of the proxy
     */
    protected $proxyDir;

    /**
     * @var string extension of the hook files.
     */
    protected $fileExtension = '.php';

    /**
     * Standard Constructor method.
     * If no namespace is given, the default namespace _Proxies is used.
     * If no proxy directory is given, the default directory Proxies is used.
     *
     * @param  Enlight_Hook_HookManager $hookManager
     * @param  string                   $proxyNamespace
     * @param  string                   $proxyDir
     * @throws RuntimeException
     */
    public function __construct($hookManager, $proxyNamespace, $proxyDir)
    {
        $this->hookManager = $hookManager;
        $this->proxyNamespace = $proxyNamespace;

        if (!is_dir($proxyDir)) {
            if (false === @mkdir($proxyDir, 0777, true) && !is_dir($proxyDir)) {
                throw new \RuntimeException(sprintf("Unable to create the %s directory (%s)\n", "Proxy", $proxyDir));
            }
        } elseif (!is_writable($proxyDir)) {
            throw new \RuntimeException(sprintf("Unable to write in the %s directory (%s)\n", "Proxy", $proxyDir));
        }

        $proxyDir = rtrim(Enlight_Loader::realpath($proxyDir), '\\/') . DIRECTORY_SEPARATOR;

        $this->proxyDir = $proxyDir;
    }

    /**
     * Returns the proxy of the given class. If the proxy is not already created
     * it is generated and written.
     * If the proxy is already created it is drawn by the
     * Shopware()->Hooks()->getHooks($class) method.
     *
     * @param  string    $class
     * @throws Exception
     * @return string
     */
    public function getProxy($class)
    {
        $proxyFile = $this->getProxyFileName($class);
        $proxy = $this->getProxyClassName($class);

        if (!is_readable($proxyFile)) {
            if (!is_writable($this->proxyDir)) {
                throw new \Exception(sprintf('The directory "%s" is not writable.', $this->proxyDir));
            }
            $content = $this->generateProxyClass($class);
            $this->writeProxyClass($proxyFile, $content);
        } elseif (!method_exists($proxy, 'executeParent')) {
            @unlink($proxyFile);
        }

        return $proxy;
    }

    /**
     * Returns proxy class name
     *
     * @param  string $class
     * @return string
     */
    public function getProxyClassName($class)
    {
        return $this->proxyNamespace . '_' . $this->formatClassName($class);
    }

    /**
     * Formats the given class name.
     *
     * @param  string $class
     * @return string
     */
    public function formatClassName($class)
    {
        return str_replace(array('_', '\\'), '', $class) . 'Proxy';
    }

    /**
     * Returns proxy file name for the given class.
     *
     * @param  string $class
     * @return string
     */
    public function getProxyFileName($class)
    {
        $proxyClassName = $this->formatClassName($class);

        return $this->proxyDir . $proxyClassName . $this->fileExtension;
    }

    /**
     * This function creates the proxy class for the given class name.
     * The proxy class extends the original class and implements the Enlight_Hook_Proxy.
     *
     * @param  string       $class
     * @return mixed|string
     */
    protected function generateProxyClass($class)
    {
        $reflectionClass = new ReflectionClass($class);

        // Make sure the we can create a proxy of the class
        CanProxyAssertion::assertClassCanBeProxied($reflectionClass, false);

        // Generate the base class
        $proxyClassName = $this->getProxyClassName($class);
        $classGenerator = new ClassGenerator($proxyClassName);
        $classGenerator->setExtendedClass($reflectionClass->getName());
        $classGenerator->setImplementedInterfaces([
            'Enlight_Hook_Proxy'
        ]);

        // Prepare generators for the hooked methods
        $hookMethods = $this->getHookedMethods($reflectionClass);
        $hookMethodGenerators = [];
        foreach ($hookMethods as $method) {
            $hookMethodGenerators[$method->getName()] = $this->createMethodGenerator($method);
        }

        // Add the default 'executeParent' method
        $executeParentGenerator = MethodGenerator::fromArray([
            'name' => 'executeParent',
            'parameters' => [
                [
                    'name' => 'method'
                ],
                [
                    'name' => 'args',
                    'defaultValue' => []
                ]
            ],
            'body' => "return call_user_func_array([\$this, 'parent::' . \$method], \$args);\n"
        ]);
        ClassGeneratorUtils::addMethodIfNotFinal($reflectionClass, $classGenerator, $executeParentGenerator);

        // Add the default 'getHookMethods' method
        $hookMethodNameString = (count($hookMethodGenerators) > 0) ? ("'" . implode("', '", array_keys($hookMethodGenerators)) . "'") : '';
        $getHookMethodsGenerator = MethodGenerator::fromArray([
            'name' => 'getHookMethods',
            'static' => true,
            'body' => "return [" . $hookMethodNameString . "];\n"
        ]);
        ClassGeneratorUtils::addMethodIfNotFinal($reflectionClass, $classGenerator, $getHookMethodsGenerator);

        // Add the hooked methods
        foreach ($hookMethodGenerators as $methodGenerator) {
            ClassGeneratorUtils::addMethodIfNotFinal($reflectionClass, $classGenerator, $methodGenerator);
        }

        // Generate the proxy file contents
        return "<?php\n" . $classGenerator->generate();
    }

    /**
     * @param ReflectionClass $class
     * @return ReflectionMethod[]
     */
    protected function getHookedMethods(ReflectionClass $class)
    {
        return array_filter(
            $class->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED),
            function (ReflectionMethod $method) use ($class) {
                return !$method->isConstructor()
                    && !$method->isFinal()
                    && !$method->isStatic()
                    && substr($method->getName(), 0, 2) !== '__'
                    && $this->hookManager->hasHooks($class->getName(), $method->getName());
            }
        );
    }

    /**
     * @param ReflectionMethod $method
     * @return MethodGenerator
     */
    protected function createMethodGenerator(ReflectionMethod $method)
    {
        $originalMethod = new MethodReflection(
            $method->getDeclaringClass()->getName(),
            $method->getName()
        );

        // Prepare parameters for the hook manager
        $params = array_map(
            function ($parameter) {
                $value = '$' . $parameter->getName();
                if ($parameter->isPassedByReference()) {
                    $value = '&' . $value;
                }

                return "'" . $parameter->getName() . "' => " . $value;
            },
            $originalMethod->getParameters()
        );

        // Create the method
        $methodGenerator = MethodGenerator::fromReflection($originalMethod);
        $methodGenerator->setDocblock('@inheritdoc');
        $methodGenerator->setBody(
            "return Shopware()->Hooks()->executeHooks(\n" .
            "    \$this,\n" .
            "    '" . $originalMethod->getName() . "',\n" .
            "    [" . implode(", ", $params) . "]\n" .
            ");\n"
        );

        return $methodGenerator;
    }

    /**
     * This function writes the generated proxy class to the file system.
     *
     * @param  string            $fileName
     * @param  string            $content
     * @throws Enlight_Exception
     */
    protected function writeProxyClass($fileName, $content)
    {
        $tmpFile = tempnam(dirname($fileName), basename($fileName));
        if (false !== @file_put_contents($tmpFile, $content) && @rename($tmpFile, $fileName)) {
            @chmod($fileName, 0666 & ~umask());

            return;
        }

        throw new Enlight_Exception('Unable to write file "' . $fileName . '"');
    }

    /**
     * Clear proxy cache
     */
    public function clearCache()
    {
        $proxies = new GlobIterator(
            $this->proxyDir . '*Proxy.php',
            FilesystemIterator::CURRENT_AS_PATHNAME
        );

        foreach ($proxies as $proxyPath) {
            @unlink($proxyPath);
        }
    }

    /**
     * @return string
     */
    public function getProxyDir()
    {
        return $this->proxyDir;
    }
}
