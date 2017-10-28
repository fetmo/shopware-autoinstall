<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_reshipment_attachments")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Attachment extends ModelEntity
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
     * @var int $reshipmentId
     *
     * @ORM\Column(name="reshipmentId", type="integer", nullable=false)
     */
    private $reshipmentId;

    /**
     * @var int $mediaId
     *
     * @ORM\Column(name="mediaId", type="integer", nullable=false)
     */
    private $mediaId;

    /**
     * OWNING SIDE
     *
     * @var Reshipment $reshipment
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment")
     * @ORM\JoinColumn(name="reshipmentId", referencedColumnName="id")
     */
    protected $reshipment;

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
     * @return Reshipment
     */
    public function getReshipment()
    {
        return $this->reshipment;
    }

    /**
     * @param Reshipment\null $reshipment
     */
    public function setReshipment(Reshipment $reshipment = null)
    {
        $this->reshipment = $reshipment;
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
