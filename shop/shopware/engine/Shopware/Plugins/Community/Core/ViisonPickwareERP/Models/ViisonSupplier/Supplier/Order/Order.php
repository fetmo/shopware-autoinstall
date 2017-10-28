<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_plugin_pickware_supplier_orders")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Order extends ModelEntity
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
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var string $orderNumber
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
     * @var float $total
     *
     * @ORM\Column(name="total", type="decimal", nullable=true, precision=10, scale=2)
     */
    private $total;

    /**
     * @var int $supplierId
     *
     * @ORM\Column(name="supplierId", type="integer", nullable=true)
     */
    private $supplierId;

    /**
     * @var int $warehouseId
     *
     * @ORM\Column(name="warehouseId", type="integer", nullable=false)
     */
    private $warehouseId;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var string $documentComment
     *
     * @ORM\Column(name="documentComment", type="string", length=255, nullable=true)
     */
    private $documentComment;

    /**
     * @var \DateTime $deliveryDate
     *
     * @ORM\Column(name="deliveryDate", type="date", nullable=true)
     */
    private $deliveryDate;

    /**
     * @var \DateTime $paymentDueDate
     *
     * @ORM\Column(name="paymentDueDate", type="date", nullable=true)
     */
    private $paymentDueDate;

    /**
     * @var int $paymentStatus
     *
     * @ORM\Column(name="paymentStatus", type="integer", nullable=true)
     */
    private $paymentStatus;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Supplier", inversedBy="orders")
     * @ORM\JoinColumn(name="supplierId", referencedColumnName="id", onDelete="SET NULL")
     */
    private $supplier;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse $warehouse
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse", inversedBy="supplierOrders")
     * @ORM\JoinColumn(name="warehouseId", referencedColumnName="id")
     */
    protected $warehouse;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\User\User $user
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\User\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Status $orderStatus
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Status")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     */
    protected $orderStatus;

    /**
     * INVERSE SIDE
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $articles
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article", mappedBy="order", orphanRemoval=true, cascade={"persist"})
     */
    private $articles;

    /**
     * INVERSE SIDE
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $attachments
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Attachment", mappedBy="order", orphanRemoval=true, cascade={"persist"})
     */
    private $attachments;

    /**
     * Creates a new Order instance.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->attachments = new ArrayCollection();
        $this->created = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime|string $created
     */
    public function setCreated($created)
    {
        $this->created = (is_string($created)) ? new \DateTime($created) : $created;
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
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Recomputes the order total.
     *
     * Computing the order total on the fly using SQL when selecting supplier orders through Doctrine is very slow.
     * Because of this, the order total is cached in a field which needs to be updated every time the articles in the
     * supplier order are changed.
     */
    public function recomputeTotal()
    {
        $this->total = 0;

        /** @var Article $article */
        foreach ($this->getArticles() as $article) {
            $this->total = $this->total + $article->getOrderedQuantity() * $article->getPrice();
        }
    }

    /**
     * @return \int
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     *
     * @param int $supplierId
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
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
     * @return string
     */
    public function getDocumentComment()
    {
        return $this->documentComment;
    }

    /**
     * @param string $documentComment
     */
    public function setDocumentComment($documentComment)
    {
        $this->documentComment = $documentComment;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime|string $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = (is_string($deliveryDate)) ? new \DateTime($deliveryDate) : $deliveryDate;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentDueDate()
    {
        return $this->paymentDueDate;
    }

    /**
     * @param \DateTime|string $paymentDueDate
     */
    public function setPaymentDueDate($paymentDueDate)
    {
        $this->paymentDueDate = (is_string($paymentDueDate)) ? new \DateTime($paymentDueDate) : $paymentDueDate;
    }

    /**
     * @return int
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param int $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     *
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier|null $supplier
     */
    public function setSupplier(\Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier = null)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return \Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse $warehouse
     */
    public function setWarehouse(\Shopware\CustomModels\ViisonPickwareERP\Warehouse\Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
        if (!$this->warehouse->getSupplierOrders()->contains($this)) {
            $this->warehouse->getSupplierOrders()->add($this);
        }
    }

    /**
     * @return \Shopware\Models\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Shopware\Models\User\User $user
     */
    public function setUser(\Shopware\Models\User\User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Status
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Status $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Attachment $attachment
     */
    public function addAttachment(\Shopware\CustomModels\ViisonSupplier\Supplier\Order\Attachment $attachment)
    {
        $this->attachments->add($attachment);
        $attachment->setOrder($this);
    }
}
