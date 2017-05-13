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
 * Adminhtml faq edit form block
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Company_Block_Adminhtml_Company_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('company_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('webinse_company')->__('Company Information'));
    }

}
