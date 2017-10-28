<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\Models\Article\Detail as ArticleDetail;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_warehouse_stocks", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="warehouseId_articleDetailId", columns={
 *          "warehouseId",
 *          "articleDetailId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Stock extends ModelEntity
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
     * @var int $warehouseId
     *
     * @ORM\Column(name="warehouseId", type="integer", nullable=false)
     */
    private $warehouseId;

    /**
     * @var int $articleDetailId
     *
     * @ORM\Column(name="articleDetailId", type="integer", nullable=false)
     */
    private $articleDetailId;

    /**
     * @var string $stock
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var string $reservedStock
     *
     * @ORM\Column(name="reservedStock", type="integer", nullable=false)
     */
    private $reservedStock;

    /**
     * OWNING SIDE
     *
     * @var Warehouse $warehouse
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse")
     * @ORM\JoinColumn(name="warehouseId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $warehouse;

    /**
     * OWNING SIDE
     *
     * @var ArticleDetail $articleDetail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Detail")
     * @ORM\JoinColumn(name="articleDetailId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $articleDetail;

    /**
     * @param Warehouse $warehouse
     * @param ArticleDetail $articleDetail
     */
    public function __construct(Warehouse $warehouse, ArticleDetail $articleDetail)
    {
        $this->setManyToOne($warehouse, Warehouse::class, 'warehouse');
        $this->articleDetail = $articleDetail;
        $this->stock = 0;
        $this->reservedStock = 0;

        // Explicitely set the both IDs which form the unique identifier of this entity, because Doctrine
        // won't do it, even though we have already set the associated entities
        $this->warehouseId = $warehouse->getId();
        $this->articleDetailId = $articleDetail->getId();
    }

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
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        return $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getReservedStock()
    {
        return $this->reservedStock;
    }

    /**
     * @param int $reservedStock
     */
    public function setReservedStock($reservedStock)
    {
        return $this->reservedStock = $reservedStock;
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * @param Warehouse $warehouse
     */
    public function setWarehouse(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
        if (!$this->warehouse->getStocks()->contains($this)) {
            $this->warehouse->getStocks()->add($this);
        }
    }

    /**
     * @return ArticleDetail
     */
    public function getArticleDetail()
    {
        return $this->articleDetail;
    }

    /**
     * @param ArticleDetail $articleDetail
     */
    public function setArticleDetail(ArticleDetail $articleDetail)
    {
        $this->articleDetail = $articleDetail;
    }
}
