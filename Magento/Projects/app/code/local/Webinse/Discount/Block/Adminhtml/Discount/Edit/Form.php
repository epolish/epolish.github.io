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
 * Adminhtml faq edit form block
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Block_Adminhtml_Discount_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('webinse_discount');
        $form = new Varien_Data_Form();
        $discount = Mage::registry('current_discount');
        $fieldset = $form->addFieldset('edit_discount', array(
            'legend' => $helper->__('Discount Information')
        ));
    
        if ($discount->getId()) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name'      => 'entity_id',
                'required'  => true,
            ));
        }

        $fieldset->addField('product_id', 'text', array(
            'name'      => 'product_id',
            'label'     => $helper->__('Product Id'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('qty_products', 'text', array(
            'name'      => 'qty_products',
            'label'     => $helper->__('Product Qty'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('item_price', 'text', array(
            'name'      => 'item_price',
            'label'     => $helper->__('Price for item'),
            'maxlength' => '250',
            'required'  => true,
        ));

        $fieldset->addField('calculate', 'button', array(
            'name'      => 'calculate',
        ));

        $fieldset->addField('subtotal', 'text', array(
            'name'      => 'subtotal',
            'label'     => $helper->__('Subtotal'),
            'maxlength' => '250',
            'style' => 'background:lightgrey;',
            'readonly' => true,
            'required'  => true,
        ));

        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues($discount->getData());
    
        $this->setForm($form);
    }

}
