<?php
/**
 * Webinse
 *
 * PHP Version 5.6.23
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Adminhtml faq edit container block
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq4_Block_Adminhtml_Faq_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'webinse_faq4';

    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_faq';
        
        if (!Mage::registry('current_faq')->getId()) {
            $this->_removeButton('delete');
        }
    }

    public function getHeaderText()
    {
        $faq = Mage::registry('current_faq');
        $helper = Mage::helper('webinse_faq4');
        
        if ($faq->getId()) {
            return $helper->__('Edit FAQ "' . $this->escapeHtml($faq->getQuestion()) . '"');
        } else {
            return $helper->__("Add new FAQ");
        }
    }

    public function getHeaderCssClass()
    {
        return 'icon-head head-faq';
    }

}
