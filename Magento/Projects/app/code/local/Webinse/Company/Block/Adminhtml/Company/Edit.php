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
 * Adminhtml faq edit container block
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Company_Block_Adminhtml_Company_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected $_blockGroup = 'webinse_company';

    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_company';
        
        if (!Mage::registry('current_company')->getId()) {
            $this->_removeButton('delete');
        }
    }

    public function getHeaderText()
    {
        $company = Mage::registry('current_company');
        $helper = Mage::helper('webinse_company');
        
        if ($company->getId()) {
            return $helper->__('Edit Company "' . $this->escapeHtml($company->getName()) . '"');
        } else {
            return $helper->__("Add new Company");
        }
    }

}
