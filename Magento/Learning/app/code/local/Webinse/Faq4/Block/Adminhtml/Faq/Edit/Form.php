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
 * Adminhtml faq edit form block
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq4_Block_Adminhtml_Faq_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare form for render
     */
    protected function _prepareForm()
    {
        $helper = Mage::helper('webinse_faq4');
        $form = new Varien_Data_Form();
        $faq = Mage::registry('current_faq');
        $fieldset = $form->addFieldset('edit_faq', array(
            'legend' => $helper->__('FAQ Information')
        ));
    
        if ($faq->getId()) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name'      => 'id',
                'required'  => true,
            ));
        }
    
        $fieldset->addField('question', 'text', array(
            'name'      => 'question',
            'label'     => $helper->__('Question'),
            'maxlength' => '250',
            'required'  => true,
        ));
    
        $fieldset->addField('answer', 'textarea', array(
            'name'      => 'answer',
            'label'     => $helper->__('Answer'),
            'style'     => 'width: 98%; height: 200px;',
            'required'  => true,
        ));
    
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues($faq->getData());
    
        $this->setForm($form);
    }

}
