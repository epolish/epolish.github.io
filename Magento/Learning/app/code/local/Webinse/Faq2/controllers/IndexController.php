<?php
/**
 * Webinse
 *
 * PHP Version 5.6.23
 *
 * @category    Webinse
 * @package     Webinse_Faq2
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Frontend index controller
 *
 * @category    Webinse
 * @package     Webinse_Faq2
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq2_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * For example you may visit the following URL http://example.com/frontName/index/getAllFaq
     */
    public function getAllFaqAction()
    {
        $collection = Mage::getModel('webinse_faq2/faq')->getCollection();
        foreach($collection as $item){
            echo '<h2>' . $item->getQuestion() . '</h2>';
            echo '<p>' . $item->getAnswer() . '</p>';
            echo '<p>' . $item->getDate() . '</p>';
        }
    }

    /**
     * For example you may visit the following URL http://example.com/frontName/index/addNewFaq?question=question1&answer=answer1
     */
    public function addNewFaqAction()
    {   
        $params = new Varien_Object($_GET);
        $faqObject = Mage::getModel('webinse_faq2/faq');

        $params->setDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'));
        $faqObject->setData($params->getData());
        $faqObject->save();
        
        echo 'New record with ID = ' . $faqObject->getId() . ' successfully added.';
    }

    /**
     * For example you may visit the following URL http://example.com/frontName/index/editFaqById/id/1
     */
    public function editFaqByIdAction()
    {
        $id = $this->getRequest()->getParam('id');
        $faqObject = Mage::getModel('webinse_faq2/faq')->load($id);
        
        $faqObject->setQuestion('question2');
        $faqObject->setDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'));
        $faqObject->save();
        
        echo 'Record with ID = ' . $faqObject->getId() . ' have been changed.';
    }

    /**
     * For example you may visit the following URL http://example.com/frontName/index/deleteFaqById/id/1
     */
    public function deleteFaqByIdAction()
    {
        $id = $this->getRequest()->getParam('id');
        $faqObject = Mage::getModel('webinse_faq2/faq')->load($id);
        
        $faqObject->delete();
        
        echo 'Record with ID = ' . $id . ' have been deleted.';
    }

}
