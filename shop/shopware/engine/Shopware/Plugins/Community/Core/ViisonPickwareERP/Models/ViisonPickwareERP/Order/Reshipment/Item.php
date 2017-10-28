<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_plugin_pickware_reshipment_items")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Item extends ModelEntity
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
     * @var int $orderDetailId
     *
     * @ORM\Column(name="orderDetailId", type="integer", nullable=false)
     */
    private $orderDetailId;

    /**
     * @var int $returnedQuantity
     *
     * @ORM\Column(name="returnedQuantity", type="integer", nullable=false)
     */
    private $returnedQuantity;

    /**
     * @var int $depreciatedQuantity
     *
     * @ORM\Column(name="depreciatedQuantity", type="integer", nullable=false)
     */
    private $depreciatedQuantity = 0;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment $reshipment
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment")
     * @ORM\JoinColumn(name="reshipmentId", referencedColumnName="id")
     */
    protected $reshipment;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\Order\Detail $orderDetail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Order\Detail")
     * @ORM\JoinColumn(name="orderDetailId", referencedColumnName="id")
     */
    protected $orderDetail;

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
    public function getReturnedQuantity()
    {
        return $this->returnedQuantity;
    }

    /**
     * @param int $returnedQuantity
     */
    public function setReturnedQuantity($returnedQuantity)
    {
        $this->returnedQuantity = $returnedQuantity;
    }

    /**
     * @return int
     */
    public function getDepreciatedQuantity()
    {
        return $this->depreciatedQuantity;
    }

    /**
     * @param int $depreciatedQuantity
     */
    public function setDepreciatedQuantity($depreciatedQuantity)
    {
        $this->depreciatedQuantity = $depreciatedQuantity;
    }

    /**
     * @return \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment
     */
    public function getReshipment()
    {
        return $this->reshipment;
    }

    /**
     * @param \Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment $reshipment
     */
    public function setReshipment(\Shopware\CustomModels\ViisonPickwareERP\Order\Reshipment\Reshipment $reshipment)
    {
        $this->reshipment = $reshipment;
    }

    /**
     * @return \Shopware\Models\Order\Detail
     */
    public function getOrderDetail()
    {
        return $this->orderDetail;
    }

    /**
     * @param \Shopware\Models\Order\Detail $orderDetail
     */
    public function setOrderDetail(\Shopware\Models\Order\Detail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }
}
