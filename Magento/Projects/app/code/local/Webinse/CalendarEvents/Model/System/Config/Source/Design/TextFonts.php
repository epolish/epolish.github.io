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
class Webinse_CalendarEvents_Model_System_Config_Source_Design_TextFonts
{

    public function toOptionArray()
    {
        return array(
            array('label' =>  Mage::helper('webinse_calendarevents')->__('Default'),
                'value' => array(
                    array('value' => 'Raleway', 'label' => Mage::helper('webinse_calendarevents')->__('Raleway'))
                )),
            array('label' =>  Mage::helper('webinse_calendarevents')->__('Serif Fonts'),
                  'value' => array(
                      array('value' => 'Georgia, serif', 'label' => Mage::helper('webinse_calendarevents')->__('Georgia, serif')),
                      array('value' => '"Palatino Linotype", "Book Antiqua", Palatino, serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Palatino Linotype", "Book Antiqua", Palatino, serif')),
                      array('value' => '"Times New Roman", Times, serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Times New Roman", Times, serif'))
                  )),
            array('label' =>  Mage::helper('webinse_calendarevents')->__('Sans-Serif Fonts'),
                'value' => array(
                    array('value' => 'Arial, Helvetica, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('Arial, Helvetica, sans-serif')),
                    array('value' => '"Arial Black", Gadget, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Arial Black", Gadget, sans-serif')),
                    array('value' => '"Comic Sans MS", cursive, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Comic Sans MS", cursive, sans-serif')),
                    array('value' => 'Impact, Charcoal, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('Impact, Charcoal, sans-serif')),
                    array('value' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Lucida Sans Unicode", "Lucida Grande", sans-serif')),
                    array('value' => 'Tahoma, Geneva, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('Tahoma, Geneva, sans-serif')),
                    array('value' => '"Trebuchet MS", Helvetica, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('"Trebuchet MS", Helvetica, sans-serif')),
                    array('value' => 'Verdana, Geneva, sans-serif', 'label' => Mage::helper('webinse_calendarevents')->__('Verdana, Geneva, sans-serif'))
                )),
            array('label' =>  Mage::helper('webinse_calendarevents')->__('Monospace Fonts'),
                'value' => array(
                    array('value' => '"Courier New", Courier, monospace', 'label' => Mage::helper('webinse_calendarevents')->__('"Courier New", Courier, monospace')),
                    array('value' => '"Lucida Console", Monaco, monospace', 'label' => Mage::helper('webinse_calendarevents')->__('"Lucida Console", Monaco, monospace'))
                ))
        );
    }

}