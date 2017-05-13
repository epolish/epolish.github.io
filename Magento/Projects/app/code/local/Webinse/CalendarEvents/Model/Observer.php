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
 * Backend calendarevents observer
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_CalendarEvents_Model_Observer extends Varien_Event_Observer
{

    public function cmsPageSaveAfter(Varien_Event_Observer $observer)
    {
        $cmsPage = $observer->getDataObject()->getData();
        $config = Mage::getStoreConfig('calendarevents_options/email');

        Mage::getModel('webinse_calendarevents/email')->sendEmail(
            'webinse_calendar_events_email',
            array('name' => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB), 'email' => $config['sender']),
            $config['recepient_email'],
            $config['recepient_name'],
            $config['email_subject'],
            array('page_id' => $cmsPage['page_id'],
                'title' => $cmsPage['title'],
                'link' => Mage::getUrl('calendarevents'))
        );
    }

    public function cmsAddFields(Varien_Event_Observer $observer)
    {
        $design = Mage::getModel('core/design_package');
        $helper = Mage::helper('webinse_calendarevents');
        $fieldSet = $observer->getForm()->getElement('base_fieldset');
        $customerGroups = Mage::getModel('customer/group')->getCollection();
        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        foreach($customerGroups as $item) {
            $values[] = array('value' => $item->getId(), 'label' => $item->getCustomerGroupCode());
        }

        $fieldSet->addField('customer_group_id', 'select', array(
            'name'      => 'customer_group_id',
            'label'     => $helper->__('Assign to Customer Group'),
            'title'     => $helper->__('Assign to Customer Group'),
            'values'    => $values,
            'required'  => true,
        ));

        $fieldSet->addField('from_date', 'date', array(
            'name'   => 'from_date',
            'label'  => $helper->__('From Date'),
            'title'  => $helper->__('From Date'),
            'image'  => $design->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'       => $dateFormatIso,
            'required'  => true,
        ));

        $fieldSet->addField('to_date', 'date', array(
            'name'   => 'to_date',
            'label'  => $helper->__('To Date'),
            'title'  => $helper->__('To Date'),
            'image'  => $design->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'       => $dateFormatIso,
            'required'  => true,
        ));
    }

}