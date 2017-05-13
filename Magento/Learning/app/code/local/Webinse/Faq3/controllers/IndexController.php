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
 * Frontend index controller
 *
 * @category    Webinse
 * @package     Webinse_Faq3
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq3_IndexController extends Mage_Core_Controller_Front_Action
{

    private function _initLayout()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * This method is output all questions and answers to them
     * For example you may visit the following URL http://example.com/frontName/index/getAllFaq
     */
    public function getAllFaqAction()
    {
        $this->_initLayout();
    }

    /**
     * Render form to add new faq
     */
    public function addNewFaqAction()
    {
        // the same form is used to create and edit
        $this->_forward('editFaqById');
    }

    /**
     * Render form to edit faq
     */
    public function editFaqByIdAction()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $handle = 'webinse_faq3_index_' . ($id ? 'edit': 'addnew') . 'faq';
        
        $this->generateLayout($handle);
    }

    /**
     * Save faq by using id or add new record
     */
    public function saveAction()
    {
        $faqObject = Mage::getModel('webinse_faq3/faq');
        $params = Mage::app()->getRequest()->getParams();
        $params['date'] = Mage::getModel('core/date')->date('Y-m-d H:i:s');
        
        if ($params['id']) {
            $message = 'Edited';
            
            $faqObject->load($params['id'])->addData($params);
        } else {
            $message = 'Added';
            
            $faqObject->setData($params);
        }
        
        $faqObject->save();
        Mage::getSingleton('core/session')->addSuccess($message . ' successfully'); 
        $this->_redirect('webinse_faq3/index/getAllFaq');
    }

    /**
     * Delete faq by id
     */
    public function deleteAction()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $faqObject = Mage::getModel('webinse_faq3/faq')->load($id);
        
        $faqObject->delete();
        Mage::getSingleton('core/session')->addNotice('Removed successfully'); 
        $this->_redirect('webinse_faq3/index/getAllFaq');
    }
  
    /**
     * This method renders layout from handle
     */
    public function generateLayout($param)
    {
        $update = $this->getLayout()->getUpdate();
        
        $update->addHandle('default');
        $this->addActionLayoutHandles();
        $update->addHandle($param);
        $this->loadLayoutUpdates();
        $this->generateLayoutXml();
        $this->generateLayoutBlocks();
        $this->_isLayoutLoaded = true;
        
        $this->renderLayout();
    }
    
}
