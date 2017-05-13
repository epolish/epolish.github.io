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
 * Business model Discount
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Model_Observer
{

    public function changePrice(Varien_Event_Observer $event)
    {
        $discount = Mage::getModel('webinse_discount/discount')->getCollection()
            ->addFieldToFilter('product_id', array('eq' => $event->getProduct()->getId()))
            ->addFieldToFilter('qty_products', array('lteq' => $event->getEvent()->getQty()))
            ->getLastItem();

        if(!is_null($discount->getItemPrice())) {
            $event->getEvent()->getProduct()->setFinalPrice($discount->getItemPrice());
        }
    }

}