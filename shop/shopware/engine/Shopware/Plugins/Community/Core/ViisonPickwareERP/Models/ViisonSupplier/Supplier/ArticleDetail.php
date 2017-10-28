<?php
namespace Shopware\CustomModels\ViisonSupplier\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_plugin_pickware_supplier_article_details", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="supplier_articleDetail", columns={
 *          "supplierId",
 *          "articleDetailId"
 *      })
 * })
 *
 * @copyright Copyright (c) 2016 VIISON GmbH
 */
class ArticleDetail extends ModelEntity
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
     * @var int $supplierId
     *
     * @ORM\Column(name="supplierId", type="integer", nullable=false)
     */
    private $supplierId;

    /**
     * @var int $articleDetailId
     *
     * @ORM\Column(name="articleDetailId", type="integer", nullable=false)
     */
    private $articleDetailId;

    /**
     * @var boolean $defaultSupplier
     *
     * @ORM\Column(name="defaultSupplier", type="boolean", nullable=false)
     */
    private $defaultSupplier = false;

    /**
     * @var float $purchasePrice
     *
     * @ORM\Column(name="purchasePrice", type="decimal", nullable=true, precision=10, scale=2)
     */
    private $purchasePrice;

    /**
     * @var string $supplierArticleNumber
     *
     * @ORM\Column(name="supplierArticleNumber", type="string", nullable=true)
     */
    private $supplierArticleNumber;

    /**
     * @var int $orderAmount
     *
     * @ORM\Column(name="orderAmount", type="integer", nullable=true)
     */
    private $orderAmount;

    /**
     * @var \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier
     *
     * @ORM\ManyToOne(targetEntity="Shopware\CustomModels\ViisonSupplier\Supplier\Supplier", inversedBy="articles")
     * @ORM\JoinColumn(name="supplierId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $supplier;

    /**
     * @var \Shopware\Models\Article\Detail
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Detail")
     * @ORM\JoinColumn(name="articleDetailId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $articleDetail;

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
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * @param int $supplierId
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return int
     */
    public function getArticleDetailId()
    {
        return $this->articleDetailId;
    }

    /**
     * @param int $articleDetailId
     */
    public function setArticleDetailId($articleDetailId)
    {
        $this->articleDetailId = $articleDetailId;
    }

    /**
     * @return
     */
    public function isDefaultSupplier()
    {
        return $this->defaultSupplier;
    }

    /**
     * @param boolean $defaultSupplier
     */
    public function setDefaultSupplier($defaultSupplier)
    {
        $this->defaultSupplier = $defaultSupplier;
    }

    /**
     * @return float
     */
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    /**
     * @param float $purchasePrice
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;
    }

    /**
     * @return int
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
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
     * @param int $orderAmount
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
    }

    /**
     * @return \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @param \Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier
     */
    public function setSupplier(\Shopware\CustomModels\ViisonSupplier\Supplier\Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return \Shopware\Models\Article\Detail
     */
    public function getArticleDetail()
    {
        return $this->articleDetail;
    }

    /**
     * @param \Shopware\Models\Article\Detail $articleDetail
     */
    public function setArticleDetail(\Shopware\Models\Article\Detail $articleDetail)
    {
        $this->articleDetail = $articleDetail;
    }
}
