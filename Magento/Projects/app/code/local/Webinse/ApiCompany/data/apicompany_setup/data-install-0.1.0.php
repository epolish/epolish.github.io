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
$connection = $installer->getConnection();

$connection->insert($installer->getTable('api_user'), array(
    'username' => 'webinse',
    'api_key' => 'adMin239'
));

$connection->insert($installer->getTable('api_role'), array(
    'role_type' => 'G',
    'role_name' => 'webinse'
));

$lastId = $connection->lastInsertId();

$connection->insert($installer->getTable('api_rule'), array(
    'role_id' => $lastId,
    'resource_id' => 'apiextended/company/list',
    'role_type' => 'G',
    'api_permission' => 'allow'
));

$installer->endSetup();