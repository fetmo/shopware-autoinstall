<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_reshipment_status")
 * @ORM\Entity
 *
 * @copyright Copyright (c) 2017 VIISON GmbH
 */
class Status extends ModelEntity
{
    const RECEIVED = 'received';
    const VALUE_RECEIVED = 1;
    const COMPLETED = 'completed';
    const VALUE_COMPLETED = 2;

    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return int
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
}
