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
 * Frontend index controller
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_CalendarEvents_IndexController extends Mage_Core_Controller_Front_Action
{

    private function _initLayout()
    {
        $this->loadLayout()->renderLayout();
    }

    public function indexAction()
    {
        $this->_initLayout();
    }

    public function getJSONDataAction()
    {
        $cmsPages = Mage::getModel('cms/page')
            ->getCollection()
            ->addFieldToSelect('page_id')
            ->addFieldToSelect('title')
            ->addFieldToSelect('from_date')
            ->addFieldToSelect('to_date');

        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($cmsPages));
    }

    public function getJSONConfigDataAction()
    {
        $config = Mage::getStoreConfig('calendarevents_options/design');

        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($config));
    }

}
