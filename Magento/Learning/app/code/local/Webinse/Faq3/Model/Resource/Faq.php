<?php
/**
 * Webinse
 *
 * PHP Version 5.6.23
 *
 * @category    Webinse
 * @package     Webinse_Faq3
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Resource model FAQ
 *
 * @category    Webinse
 * @package     Webinse_Faq3
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq3_Model_Resource_Faq extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Set main entity table name and primary key field name
     */
    protected function _construct()
    {
        $this->_init('webinse_faq3/faq', 'entity_id');
    }

}