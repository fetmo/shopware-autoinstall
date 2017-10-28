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

namespace Shopware\Components\DependencyInjection;

use Symfony\Component\DependencyInjection\Container as BaseContainer;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;

/**
 * @category  Shopware
 *
 * @copyright Copyright (c) shopware AG (http://www.shopware.de)
 */
class Container extends BaseContainer
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param \Shopware $application
     *
     * @return Container
     */
    public function setApplication(\Shopware $application)
    {
        parent::set('application', $application);

        return $this;
    }

    /**
     * Adds the given resource to the internal resource list and sets the STATUS_ASSIGNED status.
     * The given name will be used as identifier.
     *
     * @param string $name
     * @param mixed  $resource
     * @param string $scope
     *
     * @return Container
     */
    public function set($name, $resource, $scope = 'container')
    {
        $name = $this->getNormalizedId($name);

        parent::set($name, $resource);

        parent::get('events')->notify(
            'Enlight_Bootstrap_AfterRegisterResource_' . $name, [
                'subject' => $this,
                'resource' => $resource,
            ]
        );

        return $this;
    }

    /**
     * Checks if the given resource name is already registered. If not the resource is loaded.
     *t
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        $name = $this->getNormalizedId($name);

        return isset($this->services[$name]) || $this->doLoad($name);
    }

    /**
     * Checks if the given resource name is already registered.
     * Unlike as the hasResource method is, if the resource does not exist the resource will not even loaded.
     *
     * @param string $name
     *
     * @return bool
     */
    public function initialized($name)
    {
        $name = $this->getNormalizedId($name);

        return isset($this->services[$name]);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getNormalizedId($id)
    {
        $id = strtolower($id);

        if (isset($this->aliases[$id])) {
            $id = $this->aliases[$id];
        }

        return $id;
    }

    /**
     * Getter method for a single resource. If the source is not already registered, this function will
     * load the resource automatically. In case the resource is not found the status STATUS_NOT_FOUND is
     * set and an \Exception is thrown.
     *
     * @param string $name
     * @param int    $invalidBehavior
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function get($name, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        $name = $this->getNormalizedId($name);

        if (isset($this->services[$name])) {
            return $this->services[$name];
        }

        return $this->doLoad($name, $invalidBehavior);
    }

    /**
     * Loads the given resource.
     *
     * @param string $name
     *
     * @throws \Exception
     * @throws \Enlight_Exception
     *
     * @return bool
     */
    public function load($name)
    {
        $name = $this->getNormalizedId($name);

        if (isset($this->services[$name])) {
            return true;
        }

        return $this->doLoad($name) !== null;
    }

    /**
     * If the given resource is set, the resource and the resource status are removed from the
     * list properties.
     *
     * @param string $name
     *
     * @return Container
     */
    public function reset($name = null)
    {
        if ($name === null) {
            parent::reset();

            return $this;
        }

        $name = $this->getNormalizedId($name);

        parent::set($name, null);

        return $this;
    }

    /**
     * @param string $id              already normalized
     * @param int    $invalidBehavior
     *
     * @throws ServiceCircularReferenceException
     *
     * @return mixed
     */
    private function doLoad($id, $invalidBehavior = self::NULL_ON_INVALID_REFERENCE)
    {
        $eventManager = parent::get('events');

        /** @var \Enlight_Event_EventArgs|null $event */
        $event = $eventManager->notifyUntil(
            'Enlight_Bootstrap_InitResource_' . $id,
            ['subject' => $this]
        );

        $circularReference = false;

        try {
            if ($event) {
                $this->services[$id] = $event->getReturn();
            } else {
                $this->services[$id] = parent::get($id, $invalidBehavior);
            }
        } catch (ServiceCircularReferenceException $e) {
            $circularReference = true;
            throw $e;
        } finally {
            if ($circularReference === false) {
                $eventManager->notify(
                    'Enlight_Bootstrap_AfterInitResource_' . $id, ['subject' => $this]
                );
            }
        }

        return $this->services[$id];
    }
}
