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
 * Install db script
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * @var $this Mage_Core_Model_Resource_Setup
 */
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()->newTable($installer->getTable('webinse_faq4/faq'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'FAQ ID')
    ->addColumn('question', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
        ), 'FAQ Question')
    ->addColumn('answer', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        ), 'FAQ Answer')
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'FAQ User ID')
    ->addForeignKey(
        $installer->getFkName('webinse_faq4/faq', 'user_id', 'admin/user', 'user_id'),
        'user_id',
        $installer->getTable('admin/user'), 
        'user_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, 
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );

$installer->getConnection()->createTable($table);
$installer->endSetup();