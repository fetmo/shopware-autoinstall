<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_supplier_fabricators", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="supplier_fabricator", columns={
 *          "supplierId",
 *          "fabricatorId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Fabricator extends ModelEntity
{

    /**
     * @var int $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $supplierId
     *
     * @ORM\Column(name="supplierId", type="integer", nullable=false)
     */
    private $supplierId;

    /**
     * @var integer $fabricatorId
     *
     * @ORM\Column(name="fabricatorId", type="integer", nullable=false)
     */
    private $fabricatorId;

    /**
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Supplier", inversedBy="fabricators")
     * @ORM\JoinColumn(name="supplierId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $supplier;

    /**
     * @var \Shopware\Models\Article\Supplier
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Supplier")
     * @ORM\JoinColumn(name="fabricatorId", referencedColumnName="id")
     */
    protected $fabricator;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * @param int $supplierId
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier
     */
    public function setSupplier(\Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return int
     */
    public function getFabricatorId()
    {
        return $this->fabricatorId;
    }

    /**
     * @param int $fabricatorId
     */
    public function setFabricatorId($fabricatorId)
    {
        $this->fabricatorId = $fabricatorId;
    }

    /**
     * @return \Shopware\Models\Article\Supplier
     */
    public function getFabricator()
    {
        return $this->fabricator;
    }

    /**
     * @param \Shopware\Models\Article\Supplier $fabricator
     */
    public function setFabricator(\Shopware\Models\Article\Supplier $fabricator)
    {
        $this->fabricator = $fabricator;
    }
}
