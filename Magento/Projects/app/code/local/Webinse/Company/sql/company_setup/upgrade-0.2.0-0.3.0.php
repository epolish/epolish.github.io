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

$table = $installer->getConnection()->newTable($installer->getTable('webinse_company/addresses'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ), 'Address ID')
    ->addColumn('company_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Company ID')
    ->addColumn('first_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'First Name')
    ->addColumn('last_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Last name')
    ->addColumn('street_address', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Street Address')
    ->addColumn('address_city', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'City Address')
    ->addColumn('state_province', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'State/Province')
    ->addColumn('zip_postal_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Zip/Postal Code')
    ->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
    ), 'Telephone')
    ->addColumn('fax', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
    ), 'Fax')
    ->addColumn('vat_number', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
    ), 'VAT number')
    ->addForeignKey(
        $installer->getFkName('webinse_company/addresses', 'company_id', 'webinse_company/company', 'entity_id'),
        'company_id',
        $installer->getTable('webinse_company/company'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );

$installer->getConnection()->createTable($table);
$installer->endSetup();