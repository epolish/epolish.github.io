<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Business model Discount
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Model_Discount extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();

        $this->_init('webinse_discount/discount');
    }

}