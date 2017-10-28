<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\Models\Order\Detail as OrderDetail;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_plugin_pickware_warehouse_reserved_stocks", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="binLocationArticleDetailId_orderDetailId", columns={
 *          "binLocationArticleDetailId",
 *          "orderDetailId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2017 VIISON GmbH
 */
class ReservedStock extends ModelEntity
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
     * @var int $binLocationArticleDetailId
     *
     * @ORM\Column(name="binLocationArticleDetailId", type="integer", nullable=false)
     */
    private $binLocationArticleDetailId;

    /**
     * @var int $orderDetailId
     *
     * @ORM\Column(name="orderDetailId", type="integer", nullable=true)
     */
    private $orderDetailId;

    /**
     * @var int $quantity
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * OWNING SIDE
     *
     * @var BinLocationArticleDetail $binLocationArticleDetail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocationArticleDetail", inversedBy="reservedStocks")
     * @ORM\JoinColumn(name="binLocationArticleDetailId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $binLocationArticleDetail;

    /**
     * OWNING SIDE
     *
     * @var OrderDetail $orderDetail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Order\Detail")
     * @ORM\JoinColumn(name="orderDetailId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $orderDetail;

    /**
     * @param BinLocationArticleDetail $binLocationArticleDetail
     * @param int $quantity
     */
    public function __construct(BinLocationArticleDetail $binLocationArticleDetail, $quantity)
    {
        $this->binLocationArticleDetail = $binLocationArticleDetail;
        $this->binLocationArticleDetail->getReservedStocks()->add($this);
        $this->quantity = $quantity;

        // Explicitly set the FK ID, because Doctrine won't do it, even though we have already set the associated entity
        $this->binLocationArticleDetailId = $binLocationArticleDetail->getId();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return BinLocationArticleDetail
     */
    public function getBinLocationArticleDetail()
    {
        return $this->binLocationArticleDetail;
    }

    /**
     * @param BinLocationArticleDetail $binLocationArticleDetail
     */
    public function setBinLocationArticleDetail(BinLocationArticleDetail $binLocationArticleDetail)
    {
        $this->binLocationArticleDetail = $binLocationArticleDetail;
    }

    /**
     * @return OrderDetail
     */
    public function getOrderDetail()
    {
        return $this->orderDetail;
    }

    /**
     * @param OrderDetail $orderDetail
     */
    public function setOrderDetail(OrderDetail $orderDetail = null)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
