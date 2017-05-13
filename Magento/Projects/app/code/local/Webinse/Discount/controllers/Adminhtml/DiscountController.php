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
 * Backend discount controller
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Adminhtml_DiscountController extends Mage_Adminhtml_Controller_Action
{

    protected function _initDiscount()
    {
        $helper = Mage::helper('webinse_discount');
        $this->_title($helper->__('Webinse'))->_title($helper->__('Discount'));

        Mage::register('current_discount', Mage::getModel('webinse_discount/discount'));
        $discountId = $this->getRequest()->getParam('id');
        if (!is_null($discountId)) {
            Mage::registry('current_discount')->load($discountId);
        }
    }

    public function indexAction()
    {
        $this->_title($this->__('Discount'));
        $this->loadLayout();
        $this->_setActiveMenu('webinse_discount');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_initDiscount();
        $this->loadLayout();
        $this->_setActiveMenu('webinse_discount');
        $this->_addContent(
            $this->getLayout()->createBlock('webinse_discount/adminhtml_discount_edit')
        );
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_forward('new');
    }

    public function saveAction()
    {
        $helper = Mage::helper('webinse_discount');
        $session = Mage::getSingleton('adminhtml/session');
        $discountObject = Mage::getModel('webinse_discount/discount');
        $params = Mage::app()->getRequest()->getParams();
        $succesMessage = null;

            if (!empty($params)) {
                if (isset($params['entity_id'])) {
                    try {
                        $discountObject->load($params['entity_id'])->addData($params);
                        $succesMessage = $helper->__('Discount successfully edited');
                    }
                    catch (Mage_Core_Exception $e) {
                        $session->addError($e->getMessage());
                    } catch (Exception $e) {
                        Mage::logException($e);
                        $session->addError($this->__('Somethings went wrong'));
                    }
                } else {
                    try {
                        $discountObject->setData($params);
                        $succesMessage = $helper->__('Discount successfully saved');
                    }
                    catch (Mage_Core_Exception $e) {
                        $session->addError($e->getMessage());
                    } catch (Exception $e) {
                        Mage::logException($e);
                        $session->addError($this->__('Somethings went wrong'));
                    }
                }

                try {
                    $discountObject->save();
                    $session->addSuccess($succesMessage);
                } catch (Mage_Core_Exception $e) {
                    $session->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::logException($e);
                    $session->addError($this->__('Product Id is unknown'));
                }
            } else {
                $session->addError($helper->__('Values are not transferred'));
            }

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $helper = Mage::helper('webinse_discount');
        $session = Mage::getSingleton('adminhtml/session');

        try {
            $id = (int)$this->getRequest()->getParam('id');
            $discountObject = Mage::getModel('webinse_discount/discount')->load($id);

            $discountObject->delete();
            $session->addNotice($helper->__('Discount successfully deleted'));
        } catch (Mage_Core_Exception $e) {
            $session->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            $session->addError($helper->__('Somethings went wrong'));
        }

        $this->_redirectReferer();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('webinse_discount/adminhtml_discount_grid')->toHtml()
        );
    }

    public function massDeleteAction()
    {
        $discountIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($discountIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('webinse_discount')->__('Please select discount(s).'));
        } else {
            try {
                $rateModel = Mage::getModel('webinse_discount/discount');
                foreach ($discountIds as $discountId) {
                    $rateModel->load($discountId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('webinse_discount')->__(
                        'Total of %d record(s) were deleted.', count($discountIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}
