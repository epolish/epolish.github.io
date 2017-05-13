<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Business model CalendarEvents
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_CalendarEvents_Model_Email extends Mage_Core_Model_Email_Template
{

    public function sendEmail($templateId, $sender, $email, $name, $subject, $params = array())
    {
        Mage::getModel('core/email_template')->setDesignConfig(array('area' => 'frontend'))
            ->setTemplateSubject($subject)
            ->sendTransactional($templateId, $sender, $email, $name, $params);
    }

}