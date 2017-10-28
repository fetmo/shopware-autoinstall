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

namespace Shopware\Models\Property;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * Shopware Article Property Model
 *
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_filter")
 */
class Group extends ModelEntity
{
    /**
     * INVERSE SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\PropertyGroup", mappedBy="propertyGroup", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Shopware\Models\Attribute\PropertyGroup
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\Column(name="comparable", type="boolean")
     */
    private $comparable;

    /**
     * @var int
     *
     * @ORM\Column(name="sortMode", type="integer", nullable=false)
     */
    private $sortMode;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Option")
     * @ORM\JoinTable(name="s_filter_relations",
     *      joinColumns={@ORM\JoinColumn(name="groupID", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="optionID", referencedColumnName="id")}
     *      )
     */
    private $options;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="group")
     */
    private $relations;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Shopware\Models\Article\Article", mappedBy="propertyGroup", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="id", referencedColumnName="filtergroupID")
     */
    private $articles;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->relations = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param int $position
     *
     * @return Group
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set comparable
     *
     * @param int $comparable
     *
     * @return Group
     */
    public function setComparable($comparable)
    {
        $this->comparable = $comparable;

        return $this;
    }

    /**
     * Get comparable
     *
     * @return int
     */
    public function getComparable()
    {
        return $this->comparable;
    }

    /**
     * Set sort mode
     *
     * @param int $sortMode
     *
     * @return Group
     */
    public function setSortMode($sortMode)
    {
        $this->sortMode = $sortMode;

        return $this;
    }

    /**
     * Get sortMode
     *
     * @return int
     */
    public function getSortMode()
    {
        return $this->sortMode;
    }

    /**
     * Returns Array of associated Options
     *
     * @return \Shopware\Models\Property\Option[]
     */
    public function getOptions()
    {
        return $this->options->toArray();
    }

    /**
     * @param Option $option
     *
     * @return \Shopware\Models\Property\Group
     */
    public function removeOption(Option $option)
    {
        $this->options->removeElement($option);

        return $this;
    }

    /**
     * @param Option $option
     *
     * @return \Shopware\Models\Property\Group
     */
    public function addOption(Option $option)
    {
        $this->options->add($option);

        return $this;
    }

    /**
     * @param \Shopware\Models\Property\Option[] $options
     *
     * @return Group
     */
    public function setOptions(array $options)
    {
        $this->options->clear();

        foreach ($options as $option) {
            $this->addOption($option);
        }

        return $this;
    }

    /**
     * Return array of associated Articles
     *
     * @return \Shopware\Models\Article\Article[]
     */
    public function getArticles()
    {
        return $this->articles->toArray();
    }

    /**
     * @return \Shopware\Models\Attribute\PropertyGroup
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\PropertyGroup|array|null $attribute
     *
     * @return \Shopware\Models\Attribute\PropertyGroup
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\PropertyGroup', 'attribute', 'propertyGroup');
    }
}
