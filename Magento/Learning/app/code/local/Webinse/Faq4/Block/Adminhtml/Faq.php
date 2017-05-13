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
 * Adminhtml faq grid container block
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq4_Block_Adminhtml_Faq extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * this is handle to block that set in config
     */
    protected $_blockGroup = 'webinse_faq4';

    public function __construct()
    {
        /**
         * this is path to grid block
         */
        $this->_controller = 'adminhtml_faq';
        $helper = Mage::helper('webinse_faq4');

        $this->_headerText = $helper->__('FAQ List');
        $this->_addButtonLabel = $helper->__('Add FAQ');
        parent::__construct();
    }

    /**
     * Redefine header css class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-faq';
    }

}
