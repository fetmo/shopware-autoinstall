<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Article;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse;

/**
 * @ORM\Table(name="s_plugin_pickware_stocks")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Stock extends ModelEntity
{

    const TYPE_PURCHASE = 'purchase';
    const TYPE_SALE = 'sale';
    const TYPE_RETURN = 'return';
    const TYPE_STOCKTAKE = 'stocktake';
    const TYPE_MANUAL = 'manual';
    const TYPE_INCOMING = 'incoming';
    const TYPE_OUTGOING = 'outgoing';
    const TYPE_RELOCATION = 'relocation';
    const TYPE_INITIALIZATION = 'initialization';

    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var int $oldInstockQuantity
     *
     * @ORM\Column(name="oldInstockQuantity", type="integer", nullable=false)
     */
    private $oldInstockQuantity;

    /**
     * @var int $newInstockQuantity
     *
     * @ORM\Column(name="newInstockQuantity", type="integer", nullable=false)
     */
    private $newInstockQuantity;

    /**
     * @var int $changeAmount
     *
     * @ORM\Column(name="changeAmount", type="integer", nullable=true)
     */
    private $changeAmount;

    /**
     * @var float $purchasePrice
     *
     * @ORM\Column(name="purchasePrice", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $purchasePrice;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var integer $parentId
     * @ORM\Column(name="parentId", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * OWNING SIDE
     *
     * @var Shopware\CustomModels\ViisonPickwareERP\Article\Stock
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Article\Stock", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parentId", nullable=true, referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Article\Stock", mappedBy="parent", cascade={"all"}))
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $children;

    /**
     * @var integer $articleDetailId
     * @ORM\Column(name="articleDetailId", type="integer", nullable=true)
     */
    private $articleDetailId;

    /**
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Detail")
     * @ORM\JoinColumn(name="articleDetailId", referencedColumnName="id")
     * @var \Shopware\Models\Article\Detail
     */
    private $articleDetail;

    /**
     * @var integer $orderDetailId
     * @ORM\Column(name="orderDetailId", type="integer", nullable=true)
     */
    private $orderDetailId;

    /**
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Order\Detail")
     * @ORM\JoinColumn(name="orderDetailId", referencedColumnName="id")
     * @var \Shopware\Models\Order\Detail
     */
    private $orderDetail;

    /**
     * @var integer $userId
     * @ORM\Column(name="userId", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Shopware\Models\User\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * @var \Shopware\Models\User\User
     */
    private $user;

    /**
     * @var integer $supplierOrderItemId
     *
     * @ORM\Column(name="supplierOrderItemId", type="integer", nullable=true)
     */
    private $supplierOrderItemId;

    /**
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article $supplierOrderItem
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article")
     * @ORM\JoinColumn(name="supplierOrderItemId", referencedColumnName="id")
     */
    protected $supplierOrderItem;

    /**
     * @var integer $reshipmentItemId
     *
     * @ORM\Column(name="reshipmentItemId", type="integer", nullable=true)
     */
    private $reshipmentItemId;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item $reshipmentItem
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item")
     * @ORM\JoinColumn(name="reshipmentItemId", referencedColumnName="id")
     */
    protected $reshipmentItem;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocationStockSnapshot", mappedBy="stockEntry", cascade={"persist"}))
     */
    protected $binLocationSnapshots;

    /**
     * @var int $warehouseId
     *
     * @ORM\Column(name="warehouseId", type="integer", nullable=false)
     */
    private $warehouseId;

    /**
     * @var int $warehouseId
     *
     * @ORM\Column(name="transactionId", type="string", nullable=false)
     */
    private $transactionId;

    /**
     * OWNING SIDE
     *
     * @var Warehouse $warehouse
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse", inversedBy="stockEntries")
     * @ORM\JoinColumn(name="warehouseId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $warehouse;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->binLocationSnapshots = new ArrayCollection();
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        if (!in_array(
            $type,
            array(self::TYPE_PURCHASE, self::TYPE_SALE, self::TYPE_RETURN, self::TYPE_STOCKTAKE, self::TYPE_MANUAL, self::TYPE_INCOMING, self::TYPE_OUTGOING, self::TYPE_RELOCATION, self::TYPE_INITIALIZATION)
        )) {
            throw new \InvalidArgumentException("Invalid type");
        }
        $this->type = $type;
    }

    /**
     * @return integer
     */
    public function getOldInstockQuantity()
    {
        return $this->oldInstockQuantity;
    }

    /**
     * @param integer $oldInstockQuantity
     */
    public function setOldInstockQuantity($oldInstockQuantity)
    {
        $this->oldInstockQuantity = $oldInstockQuantity;
        $this->newInstockQuantity = $this->oldInstockQuantity + $this->getChangeAmount();
    }

    /**
     * @return integer
     */
    public function getNewInstockQuantity()
    {
        return $this->newInstockQuantity;
    }

    /**
     * @return integer
     */
    public function getChangeAmount()
    {
        return $this->changeAmount;
    }

    /**
     * @param integer $changeAmount
     */
    public function setChangeAmount($changeAmount)
    {
        $this->changeAmount = $changeAmount;
        $this->newInstockQuantity = $this->getOldInstockQuantity() + $this->changeAmount;
    }

    /**
     * @return float
     */
    public function getPurchasePrice()
    {
        return floatval($this->purchasePrice);
    }

    /**
     * @param float $purchasePrice
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param integer $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Article\Stock|null $stock
     */
    public function setParent(\Shopware\CustomModels\ViisonPickwareERP\Article\Stock $stock = null)
    {
        $this->parent = $stock;
    }

    /**
     * @return \Shopware\CustomModels\ViisonPickwareERP\Article\Stock
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Article\Stock[] $children
     * @return \Shopware\CustomModels\ViisonPickwareERP\Article\Stock
     */
    public function setChildren($children)
    {
        foreach ($children as $child) {
            $child->setParent($this);
        }
        $this->children = $children;

        return $this;
    }

    /**
     * @return \Shopware\CustomModels\ViisonPickwareERP\Article\Stock[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return integer
     */
    public function getArticleDetailId()
    {
        return $this->articleDetailId;
    }

    /**
     * @param integer $parentId
     */
    public function setArticleDetailId($articleDetailId)
    {
        $this->articleDetailId = $articleDetailId;
    }

    /**
     * @param \Shopware\Models\Article\Detail|null $articleDetail
     */
    public function setArticleDetail(\Shopware\Models\Article\Detail $articleDetail = null)
    {
        $this->articleDetail = $articleDetail;
    }

    /**
     * @return \Shopware\Models\Article\Detail
     */
    public function getArticleDetail()
    {
        return $this->articleDetail;
    }

    /**
     * @param \Shopware\Models\Order\Detail|null $orderDetail
     */
    public function setOrderDetail(\Shopware\Models\Order\Detail $orderDetail = null)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * @return \Shopware\Models\Order\Detail
     */
    public function getOrderDetail()
    {
        return $this->orderDetail;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param \Shopware\Models\User\User|null $user
     */
    public function setUser(\Shopware\Models\User\User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @return \Shopware\Models\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article
     */
    public function getSupplierOrderItem()
    {
        return $this->supplierOrderItem;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article|null $supplierOrderItem
     */
    public function setSupplierOrderItem(\Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article $supplierOrderItem = null)
    {
        $this->supplierOrderItem = $supplierOrderItem;
    }

    /**
     * @return \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item
     */
    public function getReshipmentItem()
    {
        return $this->reshipmentItem;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item|null $reshipmentItem
     */
    public function setReshipmentItem(\Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item $reshipmentItem = null)
    {
        $this->reshipmentItem = $reshipmentItem;
    }

    /**
     * @return ArrayCollection
     */
    public function getBinLocationSnapshots()
    {
        return $this->binLocationSnapshots;
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
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }
}
