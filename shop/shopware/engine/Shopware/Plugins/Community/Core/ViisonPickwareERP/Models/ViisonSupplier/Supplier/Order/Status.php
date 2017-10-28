<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier\Order;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_supplier_order_states")
 * @ORM\Entity
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Status extends ModelEntity
{

    const OPEN = 'open';
    const VALUE_OPEN = 0;
    const SENT_TO_SUPPLIER = 'sentToSupplier';
    const VALUE_SENT_TO_SUPPLIER = 1;
    const DISPATCHED_BY_SUPPLIER = 'dispatchedBySupplier';
    const VALUE_DISPATCHED_BY_SUPPLIER = 2;
    const PARTLY_RECEIVED = 'partlyReceived';
    const VALUE_PARTLY_RECEIVED = 3;
    const COMPLETELY_RECEIVED = 'completelyReceived';
    const VALUE_COMPLETELY_RECEIVED = 4;
    const CANCELED = 'canceled';
    const VALUE_CANCELED = 5;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
