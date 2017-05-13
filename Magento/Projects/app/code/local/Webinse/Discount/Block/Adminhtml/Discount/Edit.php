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
 * Adminhtml faq edit container block
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Block_Adminhtml_Discount_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'webinse_discount';

    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_discount';

        if (!Mage::registry('current_discount')->getId()) {
            $this->_removeButton('delete');
        }
    }

    public function getHeaderText()
    {
        $faq = Mage::registry('current_discount');
        $helper = Mage::helper('webinse_discount');
        
        if ($faq->getId()) {
            return $helper->__('Edit Discount "' . $this->escapeHtml($faq->getQuestion()) . '"');
        } else {
            return $helper->__("Add new Discount");
        }
    }

}
