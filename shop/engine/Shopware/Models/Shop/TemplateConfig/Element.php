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

namespace Shopware\Models\Shop\TemplateConfig;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Shopware\Models\Shop\Template;

/**
 * @ORM\Table(name="s_core_templates_config_elements")
 * @ORM\Entity
 */
class Element extends ModelEntity
{
    /**
     * @var Template
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Shop\Template", inversedBy="elements")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    protected $template;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *      targetEntity="Shopware\Models\Shop\TemplateConfig\Value",
     *      mappedBy="element",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    protected $values;

    /**
     * @var
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    protected $type;

    /**
     * @var
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    protected $position = 0;

    /**
     * @var
     * @ORM\Column(name="default_value", type="array", nullable=false)
     */
    protected $defaultValue;

    /**
     * @var
     * @ORM\Column(name="selection", type="array", nullable=true)
     */
    protected $selection = null;

    /**
     * @var
     * @ORM\Column(name="field_label", type="string", nullable=true)
     */
    protected $fieldLabel = null;

    /**
     * @var
     * @ORM\Column(name="support_text", type="string", nullable=true)
     */
    protected $supportText = null;

    /**
     * @var
     * @ORM\Column(name="allow_blank", type="boolean", nullable=false)
     */
    protected $allowBlank = true;

    /**
     * @var bool
     * @ORM\Column(name="less_compatible", type="boolean", nullable=false)
     */
    protected $lessCompatible = true;

    /**
     * @var string
     * @ORM\Column(name="attributes", type="array", nullable=false)
     */
    protected $attributes;

    /**
     * @var Layout
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Shop\TemplateConfig\Layout", inversedBy="elements")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    protected $container;

    /**
     * @var
     * @ORM\Column(name="container_id", type="integer", nullable=false)
     */
    protected $containerId;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var
     * @ORM\Column(name="template_id", type="integer", nullable=false)
     */
    private $templateId;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $supportText
     */
    public function setSupportText($supportText)
    {
        $this->supportText = $supportText;
    }

    /**
     * @return mixed
     */
    public function getSupportText()
    {
        return $this->supportText;
    }

    /**
     * @param \Shopware\Models\Shop\Template $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return \Shopware\Models\Shop\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $allowBlank
     */
    public function setAllowBlank($allowBlank)
    {
        $this->allowBlank = $allowBlank;
    }

    /**
     * @return mixed
     */
    public function getAllowBlank()
    {
        return $this->allowBlank;
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $fieldLabel
     */
    public function setFieldLabel($fieldLabel)
    {
        $this->fieldLabel = $fieldLabel;
    }

    /**
     * @return mixed
     */
    public function getFieldLabel()
    {
        return $this->fieldLabel;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $values
     *
     * @return \Shopware\Components\Model\ModelEntity
     */
    public function setValues($values)
    {
        return $this->setOneToMany(
            $values,
            '\Shopware\Models\Shop\TemplateConfig\Value',
            'values',
            'element'
        );
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Helper function to return the model data as
     * array.
     * Used to compare the existing theme configuration
     * with the refreshed configuration in the Shopware\Components\Theme\Manager
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'fieldLabel' => $this->fieldLabel,
            'defaultValue' => $this->defaultValue,
            'allowBlank' => $this->allowBlank,
            'position' => $this->position,
            'selection' => $this->selection,
        ];
    }

    /**
     * @return mixed
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * @param mixed $selection
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return bool
     */
    public function isLessCompatible()
    {
        return $this->lessCompatible;
    }

    /**
     * @param bool $lessCompatible
     */
    public function setLessCompatible($lessCompatible)
    {
        $this->lessCompatible = $lessCompatible;
    }
}
