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

namespace   Shopware\Models\Mail;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * Shopware mail model represents a single mail
 *
 * Associations:
 * <code>
 *   - Status     => Shopware\Models\Order\Status       [1:1]   [s_core_states]
 *   - Attachment => Shopware\Models\Mail\Attachment    [1:n]   [s_core_config_mails_attachments]
 * </code>
 *
 * Indices:
 * <code>
 *   - PRIMARY KEY (`id`)
 *   - UNIQUE KEY `name` (`name`)
 *   - UNIQUE KEY `stateId` (`stateId`)
 * </code>
 *
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_core_config_mails")
 * @ORM\HasLifecycleCallbacks
 */
class Mail extends ModelEntity
{
    /**
     * Consts defining the mailtype
     */
    const MAILTYPE_USER = 1;
    const MAILTYPE_SYSTEM = 2;
    const MAILTYPE_STATE = 3;

    /**
     * OWNING SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Order\Status", inversedBy="mail")
     * @ORM\JoinColumn(name="stateID", referencedColumnName="id")
     * @ORM\OrderBy({"position" = "ASC"})
     *
     * @var \Shopware\Models\Order\Status
     */
    protected $status;

    /**
     * INVERSE SIDE
     *
     * @ORM\OneToMany(targetEntity="Shopware\Models\Mail\Attachment", mappedBy="mail", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $attachments;

    /**
     * INVERSE SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\Mail", mappedBy="mail", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Shopware\Models\Attribute\Mail
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
     * Name of Mail
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="frommail", type="string", length=255, nullable=false)
     */
    private $fromMail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fromname", type="string", length=255, nullable=false)
     */
    private $fromName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content = '';

    /**
     * @var string
     *
     * @ORM\Column(name="contentHTML", type="text", nullable=false)
     */
    private $contentHtml = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="ishtml", type="boolean", nullable=false)
     */
    private $isHtml = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="dirty", type="boolean", nullable=true)
     */
    private $dirty = false;

    /**
     * Defines the mailtype
     * 1 - User-Defined Mail
     * 2 - System Mail
     * 3 - State Mail - Can be further differentiated into order-state-mails and payment-state-mails
     *
     * @var int
     *
     * @ORM\Column(name="mailtype", type="integer")
     */
    private $mailtype = 1;

    /**
     * @var array
     *
     * @ORM\Column(name="context", type="array")
     */
    private $context;

    /**
     * @var array
     */
    private $translation = [];

    /**
     * Constructor of Mail
     */
    public function __construct()
    {
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return \Shopware\Models\Mail\Mail
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
     * Set fromMail
     *
     *
     * @param string $fromMail
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setFromMail($fromMail)
    {
        $this->fromMail = $fromMail;

        return $this;
    }

    /**
     * Get fromMail
     *
     * @return string
     */
    public function getFromMail()
    {
        return $this->getTranslated('fromMail');
    }

    /**
     * Set fromName
     *
     * @param string $fromName
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->getTranslated('fromName');
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->getTranslated('subject');
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getTranslated('content');
    }

    /**
     * Set contentHtml
     *
     * @param string $contentHtml
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setContentHtml($contentHtml)
    {
        $this->contentHtml = $contentHtml;

        return $this;
    }

    /**
     * Get contentHtml
     *
     * @return string
     */
    public function getContentHtml()
    {
        return $this->getTranslated('contentHtml');
    }

    /**
     * Set isHtml
     *
     * @param bool $isHtml
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setIsHtml($isHtml = true)
    {
        $this->isHtml = $isHtml;

        return $this;
    }

    /**
     * isHtml-Mail
     *
     * @return int
     */
    public function isHtml()
    {
        // Checking for contentHtml will result in HTML mails being sent, even if isHTML is false.
        // So just return isHtml here again.
        return $this->isHtml;
    }

    /**
     * Returns whether or not this is a orderstate-mail
     *
     * @return bool
     */
    public function isOrderStateMail()
    {
        if ($this->getMailtype() != self::MAILTYPE_STATE) {
            return false;
        }

        if (null === $this->getStatus()) {
            return false;
        }

        return $this->getStatus()->getGroup() == 'state';
    }

    /**
     * Returns whether or not this is a paymentstate-mail
     *
     * @return bool
     */
    public function isPaymentStateMail()
    {
        if ($this->getMailtype() != self::MAILTYPE_STATE) {
            return false;
        }

        if (null === $this->getStatus()) {
            return false;
        }

        return $this->getStatus()->getGroup() == 'payment';
    }

    /**
     * Returns whether or not this is a system-mail
     *
     * @return bool
     */
    public function isSystemMail()
    {
        return $this->getMailtype() == self::MAILTYPE_SYSTEM;
    }

    /**
     * Returns whether or not this is a user-mail
     *
     * @return bool
     */
    public function isUserMail()
    {
        return $this->getMailtype() == self::MAILTYPE_USER;
    }

    /**
     * @param int $mailtype
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setMailtype($mailtype)
    {
        $this->mailtype = $mailtype;

        return $this;
    }

    /**
     * @return int
     */
    public function getMailtype()
    {
        return $this->mailtype;
    }

    /**
     * Set translation array
     *
     * @param array $translation
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translated fieldvalue if available
     *
     * @param string $fieldName
     *
     * @return string
     */
    public function getTranslated($fieldName)
    {
        if (isset($this->translation[$fieldName]) && !empty($this->translation[$fieldName])) {
            return $this->translation[$fieldName];
        }

        return $this->$fieldName;
    }

    /**
     * @param array $context
     *
     * @return \Shopware\Models\Mail\Mail
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        if (null === $this->context) {
            return [];
        }

        return $this->context;
    }

    /**
     * Flattens multidimensional array
     *
     * <code>
     *   $input = array(
     *       'sShop' => 'Shopware',
     *       'sConfig' => array(
     *           'lang'  => 'de',
     *           'sMail' => 'demo@shopware.de',
     *       )
     *   );
     *
     *   $output = array(
     *       'sShop'         => 'Shopware',
     *       'sConfig.lang'  => 'de',
     *       'sConfig.sMail' => 'demo@shopware.de'
     *   );
     * </code>
     *
     * @param $array
     * @param string $glue
     *
     * @return array
     */
    public function arrayGetPath($array, $glue = '.')
    {
        $result = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
        foreach ($iterator as $leafValue) {
            $parts = [];
            foreach (range(0, $iterator->getDepth()) as $depth) {
                $parts[] = $iterator->getSubIterator($depth)->key();
            }

            $path = implode($glue, $parts);

            $result[$path] = $leafValue;
        }

        return $result;
    }

    /**
     * @return \Shopware\Models\Order\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \Shopware\Models\Order\Status|array|null $status
     *
     * @return \Shopware\Models\Order\Status
     */
    public function setStatus($status)
    {
        $this->mailtype = self::MAILTYPE_STATE;

        return $this->setOneToOne($status, '\Shopware\Models\Order\Status', 'status', 'mail');
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAttachments()
    {
        return $this->attachments->toArray();
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection|array|null $attachments
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function setAttachments($attachments)
    {
        return $this->setOneToMany($attachments, '\Shopware\Models\Mail\Attachment', 'attachments', 'mail');
    }

    /**
     * @return \Shopware\Models\Attribute\Mail
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\Mail|array|null $attribute
     *
     * @return \Shopware\Models\Attribute\Mail
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\Mail', 'attribute', 'mail');
    }

    /**
     * @return bool
     */
    public function isDirty()
    {
        return $this->dirty;
    }

    /**
     * @param bool $dirty
     */
    public function setDirty($dirty)
    {
        $this->dirty = $dirty;
    }
}
