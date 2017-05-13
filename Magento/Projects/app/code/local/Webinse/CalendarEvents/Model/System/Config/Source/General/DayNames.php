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
class Webinse_CalendarEvents_Model_System_Config_Source_General_DayNames
{

    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label' => Mage::helper('webinse_calendarevents')->__('Abbreviation')),
            array('value' => 1, 'label' => Mage::helper('webinse_calendarevents')->__('Narrow')),
            array('value' => 2, 'label' => Mage::helper('webinse_calendarevents')->__('Wide')),
        );
    }

}