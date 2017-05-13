<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Cms page edit form main tab
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Webinse_Company_Block_Adminhtml_Company_Edit_Tab_Additional extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('webinse_company');
        $form = new Varien_Data_Form();
        $company = Mage::registry('current_company');

        $fieldset = $form->addFieldset('edit_company', array(
            'legend' => $helper->__('Company Addresses')
        ));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'first_name',
            'label'     => $helper->__('First Name'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'last_name',
            'label'     => $helper->__('Last Name'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('street_address', 'multiline', array(
            'name'      => 'street_address',
            'label'     => $helper->__('Street Address'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('address_city', 'text', array(
            'name'      => 'address_city',
            'label'     => $helper->__('City Address'),
            'maxlength' => '150',
            'required'  => true,
        ));

        $fieldset->addField('state_province', 'text', array(
            'name'      => 'state_province',
            'label'     => $helper->__('State/Province'),
            'value'   => $helper->__('USA'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('zip_postal_code', 'text', array(
            'name'      => 'zip_postal_code',
            'label'     => $helper->__('Zip/Postal Code'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('telephone', 'text', array(
            'name'      => 'telephone',
            'label'     => $helper->__('Telephone'),
            'maxlength' => '250',
        ));

        $fieldset->addField('fax', 'text', array(
            'name'      => 'fax',
            'label'     => $helper->__('Fax'),
            'maxlength' => '250',
        ));

        $fieldset->addField('vat_number', 'text', array(
            'name'      => 'vat_number',
            'label'     => $helper->__('VAT Number'),
            'maxlength' => '250',
        ));

        if($company->getId()) {
            $data = Mage::getModel('webinse_company/addresses')->load($company->getId(), 'company_id')->getData();
            $data['street_address'] = explode(',', $data['street_address']);
            $form->setValues($data);
        }

        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('webinse_company')->__('Addresses');
    }

    public function getTabTitle()
    {
        return Mage::helper('webinse_company')->__('Addresses');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('company/' . $action);
    }

}
