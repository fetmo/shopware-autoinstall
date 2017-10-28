<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Models\Article\Detail as ArticleDetail;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_warehouse_bin_locations", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="warehouseId_code", columns={
 *          "warehouseId",
 *          "code"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class BinLocation extends ModelEntity
{
    /**
     * The code used for a warehouse's default bin location.
     */
    const DEFAULT_LOCATION_CODE = 'pickware_default_location';

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
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    private $code;

    /**
     * OWNING SIDE
     *
     * @var Warehouse $warehouse
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse", inversedBy="binLocations")
     * @ORM\JoinColumn(name="warehouseId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $warehouse;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $binLocationArticleDetails
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocationArticleDetail", mappedBy="binLocation", cascade={"persist"})
     */
    protected $binLocationArticleDetails;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $stockSnapshots
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocationStockSnapshot", mappedBy="binLocation", cascade={"persist"}))
     */
    protected $stockSnapshots;

    public function __construct()
    {
        $this->binLocationArticleDetails = new ArrayCollection();
        $this->stockSnapshots = new ArrayCollection();
    }

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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
        if (!$this->warehouse->getBinLocations()->contains($this)) {
            $this->warehouse->getBinLocations()->add($this);
        }
    }

    /**
     * Fetch all BinLocationArticleDetails.
     *
     * Calling this is potentially very expensive. In particular, NEVER call this on the default BinLocation.
     *
     * @return ArrayCollection
     */
    public function getBinLocationArticleDetails()
    {
        return $this->binLocationArticleDetails;
    }

    /**
     * @param ArrayCollection $binLocationArticleDetails
     */
    public function setBinLocationArticleDetails(ArrayCollection $binLocationArticleDetails)
    {
        $this->setOneToMany($binLocationArticleDetails, BinLocationArticleDetail::class, 'binLocationArticleDetails', 'binLocation');
    }

    /**
     * @return ArrayCollection
     */
    public function getStockSnapshots()
    {
        return $this->stockSnapshots;
    }
}
