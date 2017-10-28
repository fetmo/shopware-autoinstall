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

namespace Shopware\Models\CustomerStream;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_customer_streams")
 * @ORM\Entity
 */
class CustomerStream extends ModelEntity
{
    /**
     * INVERSE SIDE
     *
     * @var \Shopware\Models\Attribute\CustomerStream
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\CustomerStream", mappedBy="customerStream", orphanRemoval=true, cascade={"persist"})
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
     * @Assert\NotBlank
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="conditions", type="string", nullable=true)
     */
    private $conditions;

    /**
     * @var bool
     * @ORM\Column(name="static", type="boolean", nullable=false)
     */
    private $static = false;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="freeze_up", type="datetime", nullable=true)
     */
    private $freezeUp;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param string|null $conditions
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * @return \DateTime|null
     */
    public function getFreezeUp()
    {
        return $this->freezeUp;
    }

    /**
     * @param $freezeUp \DateTime|string|null
     */
    public function setFreezeUp($freezeUp)
    {
        if (is_string($freezeUp)) {
            $freezeUp = new \DateTime($freezeUp);
        }
        $this->freezeUp = $freezeUp;
    }

    /**
     * @return bool
     */
    public function isStatic()
    {
        return $this->static;
    }

    /**
     * @param $static bool
     */
    public function setStatic($static)
    {
        $this->static = $static;
    }
}
