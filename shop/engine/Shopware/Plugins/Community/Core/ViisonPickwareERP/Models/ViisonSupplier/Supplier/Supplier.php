<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_plugin_pickware_suppliers")
 * @ORM\Entity(repositoryClass="Repository")
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class Supplier extends ModelEntity
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
     * @var string $salutation
     *
     * @ORM\Column(name="salutation", type="string", nullable=true)
     */
    private $salutation;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string $contact
     *
     * @ORM\Column(name="contact", type="string", nullable=false)
     */
    private $contact = '';

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string $email
     *
     * @Assert\Email
     * @Assert\NotBlank
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=40, nullable=false)
     */
    private $phone = '';

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=40, nullable=false)
     */
    private $fax = '';

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var string $customerNumber
     *
     * @ORM\Column(name="customerNumber", type="string", length=40, nullable=true)
     */
    private $customerNumber;

    /**
     * @var int $deliveryTime
     *
     * @ORM\Column(name="deliveryTime", type="integer", nullable=true)
     */
    private $deliveryTime;

    /**
     * @var int $languageId
     *
     * @ORM\Column(name="languageId", type="integer", nullable=true)
     */
    private $languageId;

    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\Shop\Locale
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Shop\Locale")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /**
     * INVERSE SIDE
     *
     * @var Doctrine\Common\Collections\ArrayCollection $articleDetails
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\ArticleDetail", mappedBy="supplier", cascade={"remove"})
     */
    protected $articleDetails;

    /**
     * INVERSE SIDE
     *
     * @var Doctrine\Common\Collections\ArrayCollection $fabricators
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Fabricator", mappedBy="supplier", cascade={"remove"})
     */
    protected $fabricators;

    /**
     * INVERSE SIDE
     *
     * @var Doctrine\Common\Collections\ArrayCollection $orders
     *
     * @ORM\OneToMany(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Order\Order", mappedBy="supplier")
     */
    protected $orders;

    /**
     * Creates a new Supplier instance.
     */
    public function __construct()
    {
        $this->articleDetails = new ArrayCollection();
        $this->fabricators = new ArrayCollection();
        $this->orders = new ArrayCollection();
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
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param string $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
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
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
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
    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    /**
     * @param string $customerNumber
     */
    public function setCustomerNumber($customerNumber)
    {
        $this->customerNumber = $customerNumber;
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
     * @return \Shopware\Models\Shop\Locale
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param \Shopware\Models\Shop\Locale $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getArticleDetails()
    {
        return $this->articleDetails;
    }

    /**
     * @param Doctrine\Common\Collections\ArrayCollection $articleDetails
     */
    public function setArticleDetails($articleDetails)
    {
        $this->articleDetails = $articleDetails;
    }

    /**
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getFabricators()
    {
        return $this->fabricators;
    }

    /**
     * @param Doctrine\Common\Collections\ArrayCollection $fabricators
     */
    public function setFabricators($fabricators)
    {
        $this->fabricators = $fabricators;
    }

    /**
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Doctrine\Common\Collections\ArrayCollection $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
    }
}
