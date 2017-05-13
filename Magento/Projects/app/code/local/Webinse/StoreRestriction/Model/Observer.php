<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_StoreRestriction
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Comment for file
 *
 * @category    Webinse
 * @package     Webinse_StoreRestriction
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_StoreRestriction_Model_Observer
{
    public function update($observer)
    {
        if(Mage::getStoreConfig('storerestriction_options/general/module_enabled')) {
            $this->checkUser();
        }
    }

    public function checkUser()
    {
        $session = Mage::getSingleton('core/session');
        $customerSession = Mage::getSingleton('customer/session');
        $configValue = Mage::getStoreConfig('storerestriction_options/general');

        if(!$customerSession->isLoggedIn() && !Mage::getSingleton('admin/session')->isLoggedIn()) {
            if(strpos($configValue['stores'], Mage::app()->getStore()->getStoreId()) !== false) {
                $session->addError($configValue['stores_error_message']);
            }
        } else {
            if(strpos($configValue['customer_groups'], $customerSession->getCustomerGroupId()) === false) {
                $session->addError($configValue['customer_groups_error_message']);
            }
        }
    }
}