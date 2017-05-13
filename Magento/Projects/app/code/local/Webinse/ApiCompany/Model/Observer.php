<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_ApiCompany
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Backend apicompany controller
 *
 * @category    Webinse
 * @package     Webinse_ApiCompany
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_ApiCompany_Model_Observer extends Varien_Event_Observer
{

    public function importCompaniesToMagentoApp()
    {
        $config = Mage::getStoreConfig('apicompany_options/general');
        $company = Mage::getModel('webinse_company/company');
        $addresses = Mage::getModel('webinse_company/addresses');
        $client = new SoapClient($config['api_url']);
        $session = $client->login($config['api_user'], $config['api_key']);
        $result = Mage::helper('core')->jsonDecode($client->apiextendedCompanyList($session));
        $client->endSession($session);

        foreach($result as $item) {
            unset($item['entity_id']);
            $company->setData($item);
            $item['company_id'] = $company->save()->getId();
            $addresses->setData($item);
            $addresses->save();
        }
    }

}