<?php
namespace Shopware\CustomModels\ViisonPickwareERP\Warehouse;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_warehouses", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="code", columns={"code"}),
 *      @ORM\UniqueConstraint(name="name", columns={"name"})
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Warehouse extends ModelEntity
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
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     */
    private $code;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var boolean $stockAvailable
     *
     * @ORM\Column(name="stockAvailable", type="boolean", nullable=false)
     */
    private $stockAvailable;

    /**
     * @var boolean $defaultWarehouse
     *
     * @ORM\Column(name="defaultWarehouse", type="boolean")
     */
    private $defaultWarehouse;

    /**
     * @var int $defaultBinLocationId
     *
     * @ORM\Column(name="defaultBinLocationId", type="integer", nullable=true)
     */
    private $defaultBinLocationId;

    /**
     * @var string $contact
     *
     * @ORM\Column(name="contact", type="string", nullable=true)
     */
    private $contact;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    private $phone;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var array $binLocationFormatComponents
     *
     * @ORM\Column(name="binLocationFormatComponents", type="array", nullable=true)
     */
    private $binLocationFormatComponents;

    /**
     * OWNING SIDE
     *
     * @var BinLocation $defaultBinLocation
     *
     * @ORM\OneToOne(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocation", inversedBy="warehouse")
     * @ORM\JoinColumn(name="defaultBinLocationId", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $defaultBinLocation;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $binLocations
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\BinLocation", mappedBy="warehouse", cascade={"persist"})
     */
    protected $binLocations;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $stockEntries
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Article\Stock", mappedBy="warehouse", cascade={"persist"})
     */
    protected $stockEntries;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $supplierOrders
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order", mappedBy="warehouse", cascade={"persist"})
     */
    protected $supplierOrders;

    /**
     * INVERSE SIDE
     *
     * @var ArrayCollection $stocks
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonPickwareERP\Warehouse\Stock", mappedBy="warehouse", cascade={"persist"})
     */
    protected $stocks;

    public function __construct()
    {
        $this->stockAvailable = true;
        $this->defaultWarehouse = false;
        $this->binLocations = new ArrayCollection();
        $this->stockEntries = new ArrayCollection();
        $this->supplierOrders = new ArrayCollection();
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
     * @return boolean
     */
    public function isStockAvailable()
    {
        return $this->stockAvailable;
    }

    /**
     * @param boolean $stockAvailable
     */
    public function setStockAvailable($stockAvailable)
    {
        $this->stockAvailable = $stockAvailable;
    }

    /**
     * @return boolean
     */
    public function isDefaultWarehouse()
    {
        return $this->defaultWarehouse;
    }

    /**
     * @param boolean $defaultWarehouse
     */
    public function setDefaultWarehouse($defaultWarehouse)
    {
        $this->defaultWarehouse = $defaultWarehouse;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
     * @return array
     */
    public function getBinLocationFormatComponents()
    {
        return $this->binLocationFormatComponents;
    }

    /**
     * @param array $binLocationFormatComponents
     */
    public function setBinLocationFormatComponents(array $binLocationFormatComponents = null)
    {
        $this->binLocationFormatComponents = $binLocationFormatComponents;
    }

    /**
     * @return BinLocation
     */
    public function getDefaultBinLocation()
    {
        return $this->defaultBinLocation;
    }

    /**
     * @param BinLocation $defaultBinLocation
     */
    public function setDefaultBinLocation(BinLocation $defaultBinLocation)
    {
        $this->defaultBinLocation = $defaultBinLocation;
        if ($this->defaultBinLocation->getWarehouse() !== $this) {
            $this->defaultBinLocation->setWarehouse($this);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getBinLocations()
    {
        return $this->binLocations;
    }

    /**
     * @param ArrayCollection $binLocations
     */
    public function setBinLocations(ArrayCollection $binLocations)
    {
        $this->setOneToMany($binLocations, BinLocation::class, 'binLocations', 'warehouse');
    }

    /**
     * @return ArrayCollection
     */
    public function getStockEntries()
    {
        return $this->stockEntries;
    }

    /**
     * @return ArrayCollection
     */
    public function getSupplierOrders()
    {
        return $this->supplierOrders;
    }

    /**
     * @return ArrayCollection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return sprintf('%s (%s)', $this->getName(), $this->getCode());
    }
}
