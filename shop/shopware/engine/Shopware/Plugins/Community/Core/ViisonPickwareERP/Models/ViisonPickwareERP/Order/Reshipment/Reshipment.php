<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_reshipments")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Reshipment extends ModelEntity
{
    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int $orderId
     *
     * @ORM\Column(name="orderId", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var int $userId
     *
     * @ORM\Column(name="userId", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int $statusId
     *
     * @ORM\Column(name="statusId", type="integer", nullable=false)
     */
    private $statusId;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\Order\Order $order
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Order\Order")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    protected $order;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\User\User $user
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\User\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $user;

    /**
     * OWNING SIDE
     *
     * @var Status $status
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Status")
     * @ORM\JoinColumn(name="statusId", referencedColumnName="id")
     */
    protected $status;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $items
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item", mappedBy="reshipment", cascade={"all"})
     */
    protected $items;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $attachments
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Attachment", mappedBy="reshipment", cascade={"all"})
     */
    protected $attachments;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->items = new ArrayCollection();
        $this->attachments = new ArrayCollection();
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
     * @param \DateTime|string $created
     */
    public function setCreated($created)
    {
        if ($created === null) {
            return;
        }

        $this->created = (is_string($created)) ? new \DateTime($created) : $created;
    }

    /**
     * @return \Shopware\Models\Order\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \Shopware\Models\Order\Order $order
     */
    public function setOrder(\Shopware\Models\Order\Order $order)
    {
        $this->order = $order;
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
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item $item
     */
    public function addItem(\Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Item $item)
    {
        $this->items->add($item);
        $item->setReshipment($this);
    }

    /**
     * @return ArrayCollection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param ArrayCollection $attachments
     */
    public function setAttachments(ArrayCollection $attachments)
    {
        $this->attachments = $attachments;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Attachment $attachment
     */
    public function addAttachment(\Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Attachment $attachment)
    {
        $this->attachments->add($attachment);
        $attachment->setReshipment($this);
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Attachment $attachment
     */
    public function removeAttachment(\Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Attachment $attachment)
    {
        if ($this->attachments->contains($attachment)) {
            $this->attachments->removeElement($attachment);
            $attachment->setReshipment(null);
        }
    }
}
