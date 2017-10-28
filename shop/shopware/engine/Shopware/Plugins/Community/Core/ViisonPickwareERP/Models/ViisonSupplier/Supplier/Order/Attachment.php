<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier\Order;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_supplier_order_attachments")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Attachment extends ModelEntity
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
     * @var integer $orderId
     *
     * @ORM\Column(name="orderId", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer $mediaId
     *
     * @ORM\Column(name="mediaId", type="integer", nullable=false)
     */
    private $mediaId;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    protected $order;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\Media\Media $media
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Media\Media")
     * @ORM\JoinColumn(name="mediaId", referencedColumnName="id")
     */
    protected $media;

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
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order $order
     */
    public function setOrder(\Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime|string $date
     */
    public function setDate($date)
    {
        $this->date = (is_string($date)) ? new \DateTime($date) : $date;
    }

    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * @param int $mediaId
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return \Shopware\Models\Media\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param \Shopware\Models\Media\Media $media
     */
    public function setMedia(\Shopware\Models\Media\Media $media)
    {
        $this->media = $media;
    }
}
