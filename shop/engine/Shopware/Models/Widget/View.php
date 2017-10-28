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

namespace Shopware\Models\Widget;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Table(name="s_core_widget_views")
 * @ORM\Entity
 */
class View extends ModelEntity
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Widget
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Widget\Widget", inversedBy="views")
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id")
     */
    private $widget;

    /**
     * @var \Shopware\Models\User\User
     * @ORM\ManyToOne(targetEntity="Shopware\Models\User\User")
     * @ORM\JoinColumn(name="auth_id", referencedColumnName="id")
     */
    private $auth;

    /**
     * @var null
     * @ORM\Column(name="auth_id", type="integer", nullable=true)
     */
    private $authId = null;

    /**
     * @var int
     * @ORM\Column(name="`column`", type="integer", nullable=false)
     */
    private $column = 0;

    /**
     * @var int
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Widget
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param Widget $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return \Shopware\Models\User\User
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param \Shopware\Models\User\User $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return int
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @param int $column
     */
    public function setColumn($column)
    {
        $this->column = $column;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
