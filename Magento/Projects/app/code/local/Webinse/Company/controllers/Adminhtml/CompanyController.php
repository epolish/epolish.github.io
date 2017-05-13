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
 * Backend company controller
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Company_Adminhtml_CompanyController extends Mage_Adminhtml_Controller_Action
{

    protected function _initCompany()
    {
        $helper = Mage::helper('webinse_company');
        $this->_title($helper->__('Webinse'))->_title($helper->__('Company'));

        Mage::register('current_company', Mage::getModel('webinse_company/company'));
        $companyId = $this->getRequest()->getParam('id');
        if (!is_null($companyId)) {
            Mage::registry('current_company')->load($companyId);
        }
    }

    public function indexAction()
    {
        $this->_title($this->__('Company'));
        $this->loadLayout();
        $this->_setActiveMenu('webinse_company');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_initCompany();
        $this->loadLayout();
        $this->_setActiveMenu('webinse_company');
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_forward('new');
    }

    public function saveAction()
    {
        $helper = Mage::helper('webinse_company');
        $session = Mage::getSingleton('adminhtml/session');
        $companyObject = Mage::getModel('webinse_company/company');
        $addressesObject = Mage::getModel('webinse_company/addresses');
        $params = Mage::app()->getRequest()->getParams();

        if (!empty($params)) {
            $params['street_address'] = implode(",", $params['street_address']);

            if (isset($params['entity_id'])) {
                try {
                    $params['company_id'] = $params['entity_id'];
                    $companyObject->load($params['entity_id'])->addData($params);
                    $addressesObject->load($params['company_id'], 'company_id');
                    $params['entity_id'] = $addressesObject->getId();
                    $addressesObject->addData($params);
                    $addressesObject->save();
                    $companyObject->save();
                    $session->addSuccess($helper->__('Company successfully edited'));
                }
                catch (Mage_Core_Exception $e) {
                    $session->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::logException($e);
                    $session->addError($this->__('Somethings went wrong'));
                }
            } else {
                try {
                    $companyObject->setData($params);
                    $companyObject->save();
                    $params['company_id'] = $companyObject->getId();
                    $addressesObject->setData($params);
                    $addressesObject->save();
                    $session->addSuccess($helper->__('Company successfully saved'));
                }
                catch (Mage_Core_Exception $e) {
                    $session->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::logException($e);
                    $session->addError($this->__('Somethings went wrong'));
                }
            }
        } else {
            $session->addError($helper->__('Values are not transferred'));
        }

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $helper = Mage::helper('webinse_company');
        $session = Mage::getSingleton('adminhtml/session');

        try {
            $id = (int)$this->getRequest()->getParam('id');
            $companyObject = Mage::getModel('webinse_company/company')->load($id);

            $companyObject->delete();
            $session->addNotice($helper->__('Company successfully deleted'));
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
            $this->getLayout()->createBlock('webinse_company/adminhtml_company_grid')->toHtml()
        );
    }

    public function massDeleteAction()
    {
        $companyIds = $this->getRequest()->getParam('entity_id');
        if(!is_array($companyIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('webinse_company')->__('Please select company(ies).'));
        } else {
            try {
                $rateModel = Mage::getModel('webinse_company/company');
                foreach ($companyIds as $companyId) {
                    $rateModel->load($companyId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('webinse_company')->__(
                        'Total of %d record(s) were deleted.', count($companyIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}
