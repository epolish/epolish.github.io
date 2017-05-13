<?php
/**
 * Webinse
 *
 * PHP Version 5.5.9
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * Install db script
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
/**
 * @var $this Mage_Core_Model_Resource_Setup
 */
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()->newTable($installer->getTable('webinse_company/company'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Company ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
        ), 'Company Name')
    ->addColumn('domains', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        ), 'Company Domains')
    ->addColumn('contact_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company Contact Name')
    ->addColumn('office_phone', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company Office Phone')
    ->addColumn('mobile_phone', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company Mobile Phone')
    ->addColumn('street', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company Street')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company City')
    ->addColumn('state', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company State')
    ->addColumn('zip', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Company Zip');

$installer->getConnection()->createTable($table);
$installer->endSetup();