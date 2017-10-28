<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\Models\Article\Detail as ArticleDetail;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_warehouse_bin_location_article_details", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="binLocationId_articleDetailId", columns={
 *          "binLocationId",
 *          "articleDetailId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class BinLocationArticleDetail extends ModelEntity
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
     * @var int $binLocationId
     *
     * @ORM\Column(name="binLocationId", type="integer", nullable=false)
     */
    private $binLocationId;

    /**
     * @var int $articleDetailId
     *
     * @ORM\Column(name="articleDetailId", type="integer", nullable=false)
     */
    private $articleDetailId;

    /**
     * @var int $stock
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * OWNING SIDE
     *
     * @var BinLocation $binLocation
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocation", inversedBy="binLocationArticleDetails")
     * @ORM\JoinColumn(name="binLocationId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $binLocation;

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
     * INVERSE SIDE
     *
     * @var ArrayCollection $reservedStocks
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\ReservedStock", mappedBy="binLocationArticleDetail", cascade={"persist"}))
     */
    protected $reservedStocks;

    /**
     * @param BinLocation $binLocation
     * @param ArticleDetail $articleDetail
     */
    public function __construct(BinLocation $binLocation, ArticleDetail $articleDetail)
    {
        $this->setManyToOne($binLocation, BinLocation::class, 'binLocation');
        $this->articleDetail = $articleDetail;
        $this->stock = 0;
        $this->reservedStocks = new ArrayCollection();

        // Explicitely set the both IDs which form the unique identifier of this entity, because Doctrine
        // won't do it, even though we have already set the assocaited entitis
        $this->binLocationId = $binLocation->getId();
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
     * @return BinLocation
     */
    public function getBinLocation()
    {
        return $this->binLocation;
    }

    /**
     * @param BinLocation $binLocation
     */
    public function setBinLocation(BinLocation $binLocation)
    {
        $this->setManyToOne($binLocation, BinLocation::class, 'binLocation');
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

    /**
     * @return ArrayCollection
     */
    public function getReservedStocks()
    {
        return $this->reservedStocks;
    }
}
