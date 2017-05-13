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

$installer->addAttribute('customer', 'company_id', array(
    'type'     => 'int',
    'label'    => 'Company',
    'input'    => 'text',
    'source'   => 'webinse_company/link',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'required' => false,
    'default'  => 0,
));

$installer->endSetup();