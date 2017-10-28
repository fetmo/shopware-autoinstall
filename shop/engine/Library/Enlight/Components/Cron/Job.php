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

/**
 * The Enlight_Components_Cron_Job represents an single cron job.
 *
 * The Enlight_Components_Cron_Job can be executed by the cron job manager.
 * When the cron job will be executed the cron job manager will pass the cron job arguments
 * to the listener method.
 *
 * @category   Enlight
 * @package    Enlight_Cron
 * @copyright  Copyright (c) 2011, shopware AG (http://www.shopware.de)
 * @license    http://enlight.de/license     New BSD License
 */
class Enlight_Components_Cron_Job
{
    /**
     * @var Integer ID of the cronjob
     */
    protected $id;

    /**
     * @var String Name or the description of the cron job: Expected data type: String
     */
    protected $name;

    /**
     * @var String Name of the action which is called during the execution phase
     */
    protected $action;

    /**
     * @var String Data storage. Can be used to store answers from cron job call
     */
    protected $data = array();

    /**
     * @var String MySQL datetime
     */
    protected $next;

    /**
     * @var String MySQL datetime. The next time the cronjob is due
     */
    protected $start;

    /**
     * @var String MySQL datetime. The time the last scheduled run ended.
     */
    protected $end;

    /**
     * @var Integer Time interval in minutes the cronjob is scheduled to run
     */
    protected $interval;

    /**
     * @var Integer Boolean value which indicates if a cronjob is enabled or not.
     * If the cronjob is disabled the cronjob will not be executed
     */
    protected $active = true;

    /**
     * @var bool Indication whether cronjob should be disabled if an error occurs during execution.
     */
    protected $disableOnError;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * This is a Cronjob Model. Following option must be provided in the options array
     *
     * id - unique identifier for a specific cronjob eg. autoincrement database field. Expected data type: Integer
     * interval - Time interval in minutes the cronjob is scheduled to run
     * next - The next time the cronjob is due. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * start - The start time of the cronjob. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * end - The time the last scheduled run ended. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * active - Boolean value which indicates if a cronjob is enabled or not. If the cronjob is disabled the cronjob
     *          will not be executed. Expected data type: boolean
     * disable_on_error - Indication whether cronjob should be disabled if an error occurs during execution. Expected data type: boolean
     * crontab - Name of the storage where all the cron jobs are stored: Expected data type: String
     * name - Name or the description of the cron job: Expected data type: String
     * action - Name of the action which is called during the execution phase. Expected data type: String
     * data - Data storage. Can be used to store answers from cron job call. Expected data type: String
     *
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * id - unique identifier for a specific cronjob eg. autoincrement database field. Expected data type: Integer
     * interval - Time interval in minutes the cronjob is scheduled to run
     * next - The next time the cronjob is due. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * start - The start time of the cronjob. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * end - The time the last scheduled run ended. Expected data type: String in form of yyyy-mm-dd hh:mm:ss
     * active - Boolean value which indicates if a cronjob is enabled or not. If the cronjob is disabled the cronjob
     *          will not be executed. Expected data type: boolean
     * disable_on_error - Indication whether cronjob should be disabled if an error occurs during execution Expected data type: boolean
     * crontab - Name of the storage where all the cron jobs are stored: Expected data type: String
     * name - Name or the description of the cron job: Expected data type: String
     * action - Name of the action which is called during the execution phase. Expected data type: String
     * data - Data storage. Can be used to store answers from cron job call. Expected data type: String
     *
     * @throws Enlight_Exception|Exception
     * @param array $options
     * @return void
     */
    public function setOptions(array $options)
    {
        foreach ($options as $fieldName => $value) {
            switch ($fieldName) {
                case 'id':
                    $this->setId($value);
                    break;
                case 'interval':
                    $this->setInterval($value);
                    break;
                case 'next':
                    $this->setNext($value);
                    break;
                case 'start':
                    $this->setStart($value);
                    break;
                case 'end':
                    $this->setEnd($value);
                    break;
                case 'active':
                    $this->setActive($value);
                    break;
                case 'disable_on_error':
                    $this->setDisableOnError($value);
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                case 'action':
                    $this->setAction($value);
                    break;
                case 'data':
                    $this->setData($value);
                    break;
                default:
                    $this->options[$fieldName] = $value;
                    break;
            }
        }
    }

    /**
     * Sets the data field
     *
     * @param mixed $data
     * @return Enlight_Components_Cron_Job
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Reads the data field and returns it
     *
     * @return String
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the ID of the job
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of the ID field
     *
     * @param int $id
     * @return Enlight_Components_Cron_Job
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Returns the Name / Descriptions of the Job
     *
     * @return \String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name/description of the job.
     *
     * @param String $name
     * @return Enlight_Components_Cron_Job
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Returns the Action of the job
     *
     * @return String
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the Action of the job
     *
     * @param String $action
     * @return Enlight_Components_Cron_Job
     */
    public function setAction($action)
    {
        $this->action = (string) $action;
        return $this;
    }

    /**
     * Returns a Zend_Date object which contains the next run time
     *
     * @return Zend_Date
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Sets the next date when the cronjob is due
     *
     * @param string|\Zend_Date $next
     * @return Enlight_Components_Cron_Job
     */
    public function setNext($next = null)
    {
        if (!$next instanceof Zend_Date) {
            $next = new Zend_Date($next, is_string($next) ? Zend_Date::ISO_8601 : null);
        }
        $this->next = $next;
        return $this;
    }

    /**
     * Returns a Zend_Date object which contains the date on which the job last run
     * @return Zend_Date
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Sets the date and time when the cronjob has been started
     *
     * @param string|\Zend_Date $start
     * @return Enlight_Components_Cron_Job
     */
    public function setStart($start = null)
    {
        if (!$start instanceof Zend_Date) {
            $start = new Zend_Date($start);
        }
        $this->start = $start;
        return $this;
    }

    /**
     * Returns the date and time when the cronjob finished its last run.
     *
     * @return Zend_Date
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets the date and time when the cronjob stopped its run.
     *
     * @param null|Zend_Date $end
     * @return Enlight_Components_Cron_Job
     */
    public function setEnd($end = null)
    {
        if ($end !== null && !$end instanceof Zend_Date) {
            $end = new Zend_Date($end);
        }
        $this->end = $end;
        return $this;
    }

    /**
     * Returns the interval in seconds a cron has to be scheduled
     *
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Sets the interval in seconds a cron has to be scheduled
     *
     * @param int $interval
     * @return Enlight_Components_Cron_Job
     */
    public function setInterval($interval)
    {
        $this->interval = (int) $interval;
        return $this;
    }

    /**
     * Checks if the cronjob is active
     *
     * @return int
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Alias for isActive
     *
     * @return int
     */
    public function getActive()
    {
        return $this->isActive();
    }

    /**
     * Sets the cronjob either active or inactive
     *
     * @param bool $active
     * @return Enlight_Components_Cron_Job
     */
    public function setActive($active)
    {
        $this->active = (boolean) $active;
        return $this;
    }

    /**
     * Checks if the cronjob should be disabled when an error occurs during execution
     *
     * @return int
     */
    public function getDisableOnError()
    {
        return $this->disableOnError;
    }

    /**
     * Sets the indication for disabling the cronjob when an error occurs during execution.
     *
     * @param bool $disableOnError
     * @return Enlight_Components_Cron_Job
     */
    public function setDisableOnError($disableOnError)
    {
        $this->disableOnError = (boolean) $disableOnError;
        return $this;
    }

    /**
     * Method to get the options
     *
     * @param   $name
     * @param   mixed $default
     * @return  mixed
     */
    public function get($name, $default = null)
    {
        if (isset($this->$name)) {
            return $this->$name;
        } elseif (isset($this->options[$name])) {
            return $this->options[$name];
        }
        return $default;
    }

    /**
     * Magic method to get parameters
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }
}
