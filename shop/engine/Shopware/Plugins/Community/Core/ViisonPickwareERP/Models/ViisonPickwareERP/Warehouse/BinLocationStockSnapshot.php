<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\CustomModels\ViisonPickwareERP\Article\Stock as StockEntry;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_warehouse_bin_location_stock_snapshots", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="stockEntryId_binLocationId", columns={
 *          "stockEntryId",
 *          "binLocationId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class BinLocationStockSnapshot extends ModelEntity
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
     * @var int $stockEntryId
     *
     * @ORM\Column(name="stockEntryId", type="integer", nullable=false)
     */
    private $stockEntryId;

    /**
     * @var int $binLocationId
     *
     * @ORM\Column(name="binLocationId", type="integer", nullable=false)
     */
    private $binLocationId;

    /**
     * @var int $stock
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * OWNING SIDE
     *
     * @var StockEntry $stock
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Article\Stock", inversedBy="binLocationSnapshots")
     * @ORM\JoinColumn(name="stockEntryId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $stockEntry;

    /**
     * OWNING SIDE
     *
     * @var BinLocation $binLocation
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocation", inversedBy="stockSnapshots")
     * @ORM\JoinColumn(name="binLocationId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $binLocation;

    /**
     * @param StockEntry $stockEntry
     * @param BinLocation $binLocation
     * @param int $stock
     */
    public function __construct(StockEntry $stockEntry, BinLocation $binLocation, $stock)
    {
        $this->stockEntry = $stockEntry;
        $this->stockEntry->getBinLocationSnapshots()->add($this);
        $this->binLocation = $binLocation;
        $this->binLocation->getStockSnapshots()->add($this);
        $this->stock = $stock;

        // Explicitly set the two IDs, which form the unique identifier of this entity, because Doctrine
        // won't do it, even though we have already set the associated entities
        $this->stockEntryId = $stockEntry->getId();
        $this->binLocationId = $binLocation->getId();
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
     * @return StockEntry
     */
    public function getStockEntry()
    {
        return $this->stockEntry;
    }

    /**
     * @return BinLocation
     */
    public function getBinLocation()
    {
        return $this->binLocation;
    }
}
