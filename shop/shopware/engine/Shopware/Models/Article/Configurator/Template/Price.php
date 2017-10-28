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

namespace Shopware\Models\Article\Configurator\Template;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\LazyFetchModelEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_article_configurator_template_prices")
 */
class Price extends LazyFetchModelEntity
{
    /**
     * OWNING SIDE
     *
     * @var \Shopware\Models\Article\Configurator\Template\Template
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Article\Configurator\Template\Template", inversedBy="prices")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     * @ORM\OrderBy({"customerGroupKey" = "ASC", "from" = "ASC"})
     */
    protected $template;

    /**
     * INVERSE SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\TemplatePrice", mappedBy="templatePrice", cascade={"persist"})
     *
     * @var \Shopware\Models\Attribute\TemplatePrice
     */
    protected $attribute;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="template_id", type="integer", nullable=false)
     */
    private $templateId;

    /**
     * @var string
     * @ORM\Column(name="customer_group_key", type="string", length=30, nullable=false)
     */
    private $customerGroupKey = '';

    /**
     * @var int
     *
     * @ORM\Column(name="`from`", type="integer", nullable=false)
     */
    private $from;

    /**
     * @var int
     *
     * @ORM\Column(name="`to`", type="string", nullable=true)
     */
    private $to = 'beliebig';

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="pseudoprice", type="float", nullable=false)
     */
    private $pseudoPrice = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="percent", type="float", nullable=false)
     */
    private $percent = 0;

    /**
     * @var \Shopware\Models\Customer\Group
     *
     * @ORM\OneToOne(targetEntity="\Shopware\Models\Customer\Group")
     * @ORM\JoinColumn(name="customer_group_key", referencedColumnName="groupkey")
     */
    private $customerGroup;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set priceGroup
     *
     * @param $customerGroup
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = $customerGroup;

        return $this;
    }

    /**
     * Get priceGroup
     *
     * @return \Shopware\Models\Customer\Group
     */
    public function getCustomerGroup()
    {
        return $this->fetchLazy($this->customerGroup, ['key' => $this->customerGroupKey]);
    }

    /**
     * Set from
     *
     * @param $from
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return int
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param $to
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setTo($to)
    {
        if ($to === null) {
            $to = 'beliebig';
        }
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return int|null
     */
    public function getTo()
    {
        return $this->to < 0 ? null : $this->to;
    }

    /**
     * Set price
     *
     * @param $price
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set pseudoPrice
     *
     * @param $pseudoPrice
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setPseudoPrice($pseudoPrice)
    {
        $this->pseudoPrice = $pseudoPrice;

        return $this;
    }

    /**
     * Get pseudoPrice
     *
     * @return float
     */
    public function getPseudoPrice()
    {
        return $this->pseudoPrice;
    }

    /**
     * Set percent
     *
     * @param float $percent
     *
     * @return \Shopware\Models\Article\Configurator\Template\Price
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return float
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @return \Shopware\Models\Attribute\TemplatePrice
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\TemplatePrice|array|null $attribute
     *
     * @return \Shopware\Components\Model\ModelEntity
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\TemplatePrice', 'attribute', 'templatePrice');
    }

    /**
     * @return \Shopware\Models\Article\Configurator\Template\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param \Shopware\Models\Article\Configurator\Template\Template $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
