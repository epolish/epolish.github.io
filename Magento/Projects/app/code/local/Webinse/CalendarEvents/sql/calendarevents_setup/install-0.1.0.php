<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Install db script
 *
 * @category    Webinse
 * @package     Webinse_CalendarEvents
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * @var $this Mage_Core_Model_Resource_Setup
 */

$installer = $this;
$installer->startSetup();
$connection = $installer->getConnection();
$cmsTable = $installer->getTable('cms/page');

$connection->addColumn($cmsTable,'customer_group_id', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable'  => false,
    'default'   => 0,
    'comment'   => 'Customer Group Id'
));
$connection->addColumn($cmsTable,'from_date', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable'  => false,
        'comment'   => 'From Date'
    ));
$connection->addColumn($cmsTable,'to_date', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable'  => false,
        'comment'   => 'To Date'
    ));
$connection->addForeignKey(
    $installer->getFkName('cms/page', 'customer_group_id', 'customer/customer_group', 'customer_group_id'),
    $cmsTable, 'customer_group_id',
    $installer->getTable('customer/customer_group'), 'customer_group_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$installer->endSetup();