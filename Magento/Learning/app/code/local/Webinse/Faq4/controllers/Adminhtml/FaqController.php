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
 * Backend faq controller
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq4_Adminhtml_FaqController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init actions
     *
     * @return Webinse_Faq4_Model_Faq
     */
    protected function _initFaq()
    {
        $helper = Mage::helper('webinse_faq4');
        $this->_title($helper->__('Webinse'))->_title($helper->__('FAQ'));

        /**
         * you can see about register method there http://alanstorm.com/magento_registry_singleton_tutorial
         */
        Mage::register('current_faq', Mage::getModel('webinse_faq4/faq'));
        $faqId = $this->getRequest()->getParam('id');
        if (!is_null($faqId)) {
            Mage::registry('current_faq')->load($faqId);
        }
    }

    /**
     * Faq grid
     */
    public function indexAction()
    {
        $this->_title($this->__('FAQ'));
        $this->loadLayout();
        $this->_setActiveMenu('webinse_faq4');
        $this->renderLayout();
    }

    /**
     * Edit or create faq
     */
    public function newAction()
    {
        $this->_initFaq();
        $this->loadLayout();
        $this->_setActiveMenu('webinse_faq4');
        $this->_addContent(
            $this->getLayout()->createBlock('webinse_faq4/adminhtml_faq_edit')
        );
        $this->renderLayout();
    }

    /**
     * Edit faq action. Forward to new action.
     */
    public function editAction()
    {
        $this->_forward('new');
    }

    /**
     * Create or save faq.
     */
    public function saveAction()
    {
        $redirect = 'adminhtml/faq/index';
        $helper = Mage::helper('webinse_faq4');
        $session = Mage::getSingleton('core/session');
        $faqObject = Mage::getModel('webinse_faq4/faq');
        $params = Mage::app()->getRequest()->getParams();
        $params['user_id'] = Mage::getSingleton('admin/session')->getUser()->getUserId();

        if ($params['id']) {
            $message = 'Edited';
            
            $faqObject->load($params['id'])->addData($params);
        } else {
            $message = 'Added';
            
            $faqObject->setData($params);
        }
        
        $faqObject->save();
        $session->addSuccess($helper->__($message . ' successfully')); 
        $this->_redirect($redirect);
    }

    /**
     * Delete faq action
     */
    public function deleteAction()
    {
        $redirect = 'adminhtml/faq/index';
        $helper = Mage::helper('webinse_faq4');
        $session = Mage::getSingleton('core/session');
        
        try {
            $id = (int)$this->getRequest()->getParam('id');
            $faqObject = Mage::getModel('webinse_faq4/faq')->load($id);

            $faqObject->delete();
            $session->addNotice($helper->__('Removed successfully'));
        } catch (Exception $ex) {
            Mage::log($ex->getMessage());
            $session->addWarning($helper->__('Some errors'));
        }
        
        $this->_redirect($redirect);
    }

}
