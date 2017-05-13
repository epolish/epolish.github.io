<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_ApiExtended
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Backend apiExtended resource model
 *
 * @category    Webinse
 * @package     Webinse_ApiExtended
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_ApiExtended_Model_Company_Api extends Mage_Api_Model_Resource_Abstract
{

    public function items()
    {
        $collection = Mage::getModel('webinse_company/addresses')->getCollection();

        $collection->getSelect()->join(
            'webinse_company',
            'main_table.company_id = webinse_company.entity_id'
        );

        return Mage::helper('core')->jsonEncode($collection->getData());
    }

}