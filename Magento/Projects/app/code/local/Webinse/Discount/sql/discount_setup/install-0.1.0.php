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
 * Install db script
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * @var $this Mage_Core_Model_Resource_Setup
 */
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()->newTable($installer->getTable('webinse_discount/discount'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Discount ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Product ID')
    ->addColumn('qty_products', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'subtotal')
    ->addColumn('item_price', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        'nullable' => true,
    ), 'Price')
    ->addColumn('subtotal', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        'nullable' => true,
    ), 'Subtotal')
    ->addForeignKey(
        $installer->getFkName('webinse_discount/discount', 'product_id', 'catalog/product', 'entity_id'),
        'product_id',
        $installer->getTable('catalog/product'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );


$installer->getConnection()->createTable($table);
$installer->endSetup();