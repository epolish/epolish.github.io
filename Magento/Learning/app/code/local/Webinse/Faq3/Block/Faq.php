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
 * Frontend block FAQ
 *
 * @category    Webinse
 * @package     Webinse_Faq3
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq3_Block_Faq extends Mage_Core_Block_Template
{

    /**
     * Retrieve all faq sorted by date
     * 
     * @return Webinse_Faq3_Model_Resource_Faq_Collection
     */
    public function getAllFaq()
    {
        return Mage::getModel('webinse_faq3/faq')->getCollection();
    }

    /**
     * Retrieve faq by id
     *
     * @return Webinse_Faq3_Model_Faq
     */
    public function getFaqById()
    {
        return Mage::getModel('webinse_faq3/faq')->load($this->getRequest()->getParam('id'));
    }

}