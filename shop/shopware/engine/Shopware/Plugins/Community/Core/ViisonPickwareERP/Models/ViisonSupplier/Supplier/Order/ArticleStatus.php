<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier\Order;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_supplier_order_article_detail_states")
 * @ORM\Entity
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class ArticleStatus extends ModelEntity
{

    const OPEN = 'open';
    const PARTLY_RECEIVED = 'partlyReceived';
    const COMPLETELY_RECEIVED = 'completelyReceived';
    const CANCELED = 'canceled';
    const REFUND = 'refund';
    const MISSING = 'missing';

    /**
     * @var int $id
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
