<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Backend company controller
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Company_Model_Observer extends Varien_Event_Observer
{

    public function appendCompanyIdColumn(Varien_Event_Observer $observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }

        if ($block->getType() == 'adminhtml/customer_grid') {
            $block->addColumnAfter('companyname', array(
                'header' => Mage::helper('webinse_company')->__('Company Name'),
                'index' => 'companyname'
            ), 'billing_region');
        }
    }

    public function customerSaveBefore(Varien_Event_Observer $observer)
    {
        $company = null;
        $customer = $observer->getEvent()->getCustomer();
        $emailDomain = substr(strrchr($customer->getEmail(), "@"), 1);
        $companies = Mage::getModel('webinse_company/company')->getCollection();

        foreach ($companies as $item) {
            if(strpos($item->getDomains(), $emailDomain) !== false) {
                $company = $item;
                break;
            }
        }

        if($company != null) {
            $customer->setCompanyId($company->getId());
        } else {
            Mage::throwException(Mage::helper('webinse_company')->__('Your email is not acceptable in our system.'));
        }
    }

    public function checkoutOnepage(Varien_Event_Observer $observer)
    {
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $company = $this->getCurrentUserCompanyInformation();

        $billing = $quote->getBillingAddress()->getData();
        $shipping = $quote->getShippingAddress()->getData();

        $shipingAddress = $quote->getShippingAddress();
        $shipingAddress->setCompany($company['name'])
                        ->setStreet(explode(',', $company['street_address']))
                        ->setCity($company['city'])
                        ->setRegion($company['state_province'])
                        ->setPostcode($company['zip_postal_code'])
                        ->setTelephone($company['telephone'])
                        ->setFax($company['fax'])
                        ->save();
    }

    public function saveShippingMethod(Varien_Event_Observer $observer)
    {
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $difference = array_diff($quote->getBillingAddress()->getData(), $quote->getShippingAddress()->getData());

        if(count($difference) <= 2) {
            $controller = $observer->getControllerAction();
            $controller->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
            $response = array('error' => -1, 'message' => Mage::helper('webinse_company')->__('Shipping should not be same as billing.'));
            return $controller->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }

    protected function getCurrentUserCompanyInformation()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $email = substr(strrchr($customer->getEmail(), "@"), 1);
        $collection = Mage::getSingleton('webinse_company/addresses')->getCollection();

        $collection->getSelect()->join(
            'webinse_company',
            'main_table.company_id = webinse_company.entity_id'
        );
        $collection->addFieldToFilter('domains', array('like' => '%'.$email.'%'));

        return $collection->getLastItem()->getData();
    }

}