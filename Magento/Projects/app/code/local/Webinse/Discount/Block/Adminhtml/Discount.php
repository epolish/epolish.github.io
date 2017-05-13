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
 * Adminhtml company grid container block
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Block_Adminhtml_Discount extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected $_blockGroup = 'webinse_discount';

    public function __construct()
    {
        $this->_controller = 'adminhtml_discount';
        $helper = Mage::helper('webinse_discount');

        $this->_headerText = $helper->__('Discount List');
        $this->_addButtonLabel = $helper->__('Add Discount');
        parent::__construct();
    }

}
