<?php

namespace Shopware\CustomModels\ViisonSupplier\Supplier\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_supplier_order_article_details")
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\HasLifecycleCallbacks
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Article extends ModelEntity
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
     * @var int $orderId
     *
     * @ORM\Column(name="orderId", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var integer $articleDetailId
     *
     * @ORM\Column(name="articleDetailId", type="integer", nullable=true)
     */
    private $articleDetailId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="orderNumber", type="string", length=40, nullable=false)
     */
    private $orderNumber;

    /**
     * @var int $status
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="orderedQuantity", type="integer")
     */
    private $orderedQuantity;

    /**
     * @var int
     *
     * @ORM\Column(name="deliveredQuantity", type="integer")
     */
    private $deliveredQuantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", nullable=true, precision=10, scale=2)
     */
    private $price;

    /**
     * @var int $deliveryTime
     *
     * @ORM\Column(name="deliveryTime", type="integer", nullable=true)
     */
    private $deliveryTime;

    /**
     * @var string
     *
     * @ORM\Column(name="fabricatorName", type="string", length=255, nullable=true)
     */
    private $fabricatorName;

    /**
     * @var string
     *
     * @ORM\Column(name="fabricatorNumber", type="string", length=255, nullable=true)
     */
    private $fabricatorNumber;

    /**
     * @var string $supplierArticleNumber
     *
     * @ORM\Column(name="supplierArticleNumber", type="string", nullable=true)
     */
    private $supplierArticleNumber;

    /**
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    protected $order;

    /**
     * @var \Shopware\Models\Article\Detail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Detail")
     * @ORM\JoinColumn(name="articleDetailId", referencedColumnName="id")
     */
    protected $articleDetail;

    /**
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Order\ArticleStatus $itemStatus
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\ArticleStatus")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     */
    protected $itemStatus;

    /**
     * INVERSE SIDE
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $stocks
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Article\Stock", mappedBy="supplierOrderItem", cascade={"persist"})
     */
    protected $stocks;

    /**
     * Creates a new Article instance.
     */
    public function __construct()
    {
        $this->deliveredQuantity = 0;
        $this->stocks = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Order \Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order|null $order
     */
    public function setOrder(\Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order $order = null)
    {
        $this->order = $order;
    }

    /**
     * @return \Shopware\Models\Article\Detail
     */
    public function getArticleDetail()
    {
        return $this->articleDetail;
    }

    /**
     * @param \Shopware\Models\Article\Detail|null $articleDetail
     */
    public function setArticleDetail(\Shopware\Models\Article\Detail $articleDetail = null)
    {
        $this->articleDetail = $articleDetail;
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
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Order\ArticleStatus
     */
    public function getStatus()
    {
        return $this->itemStatus;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\ArticleStatus $itemStatus
     */
    public function setStatus(\Shopware\CustomModels\ViisonSupplier\Supplier\Order\ArticleStatus $itemStatus = null)
    {
        $this->itemStatus = $itemStatus;
    }

    /**
     * @return int
     */
    public function getOrderedQuantity()
    {
        return $this->orderedQuantity;
    }

    /**
     * @param int $orderedQuantity
     */
    public function setOrderedQuantity($orderedQuantity)
    {
        $this->orderedQuantity = $orderedQuantity;
    }

    /**
     * @return int
     */
    public function getDeliveredQuantity()
    {
        return $this->deliveredQuantity;
    }

    /**
     * @param int $deliveredQuantity
     */
    public function setDeliveredQuantity($deliveredQuantity)
    {
        $this->deliveredQuantity = $deliveredQuantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @param int $deliveryTime
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * @return string
     */
    public function getFabricatorName()
    {
        return $this->fabricatorName;
    }

    /**
     * @param string $fabricatorName
     */
    public function setFabricatorName($fabricatorName)
    {
        $this->fabricatorName = $fabricatorName;
    }

    /**
     * @return string
     */
    public function getFabricatorNumber()
    {
        return $this->fabricatorNumber;
    }

    /**
     * @param string $fabricatorNumber
     */
    public function setFabricatorNumber($fabricatorNumber)
    {
        $this->fabricatorNumber = $fabricatorNumber;
    }

    /**
     * @param $supplierArticleNumber
     */
    public function setSupplierArticleNumber($supplierArticleNumber)
    {
        $this->supplierArticleNumber = $supplierArticleNumber;
    }

    /**
     * @return string
     */
    public function getSupplierArticleNumber()
    {
        return $this->supplierArticleNumber;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $stocks
     */
    public function setStocks(\Doctrine\Common\Collections\ArrayCollection $stocks)
    {
        $this->stocks = $stocks;
    }

    /**
     * Removes all associated stocks from this article by removing the respective
     * stock entities' 'supplierOrderItem' before clearing the list.
     */
    public function clearStocks()
    {
        foreach ($this->stocks->toArray() as $stock) {
            $stock->setSupplierOrderItem(null);
        }
        $this->stocks->clear();
    }

    /**
     * @ORM\PreRemove
     */
    public function onPreRemove()
    {
        $this->clearStocks();
    }
}
