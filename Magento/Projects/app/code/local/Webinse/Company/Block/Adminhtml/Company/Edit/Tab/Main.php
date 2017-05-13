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

class Webinse_Company_Block_Adminhtml_Company_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('webinse_company');
        $form = new Varien_Data_Form();
        $company = Mage::registry('current_company');

        $fieldset = $form->addFieldset('edit_company', array(
            'legend' => $helper->__('Company Information')
        ));

        if ($company->getId()) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name'      => 'entity_id',
                'required'  => true,
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $helper->__('Name'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('domains', 'text', array(
            'name'      => 'domains',
            'label'     => $helper->__('Domains'),
            'after_element_html' => '<p class="nm">
                <small>'.$helper->__('separator - "," without space').'</small>
            </p>',
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('contact_name', 'text', array(
            'name'      => 'contact_name',
            'label'     => $helper->__('Contact Name'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('office_phone', 'text', array(
            'name'      => 'office_phone',
            'label'     => $helper->__('Office Phone'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('mobile_phone', 'text', array(
            'name'      => 'mobile_phone',
            'label'     => $helper->__('Mobile Phone'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('street', 'text', array(
            'name'      => 'street',
            'label'     => $helper->__('Street'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'city',
            'label'     => $helper->__('City'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('state', 'text', array(
            'name'      => 'state',
            'label'     => $helper->__('State'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('zip', 'text', array(
            'name'      => 'zip',
            'label'     => $helper->__('Zip'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $form->setValues($company->getData());
        $this->setForm($form);


        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('webinse_company')->__('Company Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('webinse_company')->__('Company Information');
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
