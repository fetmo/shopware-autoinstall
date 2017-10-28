<?php

/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */


namespace Shopware\Models\Attribute;
use Shopware\Components\Model\ModelEntity,
    Doctrine\ORM\Mapping AS ORM,
    Symfony\Component\Validator\Constraints as Assert,
    Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="s_order_shippingaddress_attributes")
 */
class OrderShipping extends ModelEntity
{
    

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
     protected $id;


    /**
     * @var integer $orderShippingId
     *
     * @ORM\Column(name="shippingID", type="integer", nullable=true)
     */
     protected $orderShippingId;


    /**
     * @var string $text1
     *
     * @ORM\Column(name="text1", type="text", nullable=true)
     */
     protected $text1;


    /**
     * @var string $text2
     *
     * @ORM\Column(name="text2", type="text", nullable=true)
     */
     protected $text2;


    /**
     * @var string $text3
     *
     * @ORM\Column(name="text3", type="text", nullable=true)
     */
     protected $text3;


    /**
     * @var string $text4
     *
     * @ORM\Column(name="text4", type="text", nullable=true)
     */
     protected $text4;


    /**
     * @var string $text5
     *
     * @ORM\Column(name="text5", type="text", nullable=true)
     */
     protected $text5;


    /**
     * @var string $text6
     *
     * @ORM\Column(name="text6", type="text", nullable=true)
     */
     protected $text6;


    /**
     * @var \Shopware\Models\Order\Shipping
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Order\Shipping", inversedBy="attribute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shippingID", referencedColumnName="id")
     * })
     */
    protected $orderShipping;
    


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    

    public function getOrderShippingId()
    {
        return $this->orderShippingId;
    }

    public function setOrderShippingId($orderShippingId)
    {
        $this->orderShippingId = $orderShippingId;
        return $this;
    }
    

    public function getText1()
    {
        return $this->text1;
    }

    public function setText1($text1)
    {
        $this->text1 = $text1;
        return $this;
    }
    

    public function getText2()
    {
        return $this->text2;
    }

    public function setText2($text2)
    {
        $this->text2 = $text2;
        return $this;
    }
    

    public function getText3()
    {
        return $this->text3;
    }

    public function setText3($text3)
    {
        $this->text3 = $text3;
        return $this;
    }
    

    public function getText4()
    {
        return $this->text4;
    }

    public function setText4($text4)
    {
        $this->text4 = $text4;
        return $this;
    }
    

    public function getText5()
    {
        return $this->text5;
    }

    public function setText5($text5)
    {
        $this->text5 = $text5;
        return $this;
    }
    

    public function getText6()
    {
        return $this->text6;
    }

    public function setText6($text6)
    {
        $this->text6 = $text6;
        return $this;
    }
    

    public function getOrderShipping()
    {
        return $this->orderShipping;
    }

    public function setOrderShipping($orderShipping)
    {
        $this->orderShipping = $orderShipping;
        return $this;
    }
    
}