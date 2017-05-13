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

$settings = array(
    'background' => '#ff0000',
    'background_current' => '#ff0000',
    'text_color' => '#ff0000',
    'text_size' => '170',
    'text_font' => 'Railway'
);

$instance = Mage::getModel('widget/widget_instance')->setData(array(
    'type' => 'webinse_calendarevents/widget',
    'package_theme' => 'rwd/default',
    'title' => 'Calendar Widget',
    'store_ids' => '0',
    'widget_parameters' => serialize($settings),
    'page_groups' => array(array(
        'page_group' => 'all_pages',
        'all_pages' => array(
            'page_id' => null,
            'group' => 'all_pages',
            'layout_handle' => 'default',
            'block' => 'left',
            'for' => 'all',
            'template' => 'webinse/calendar_events/widget/widget.phtml',
        )
    ))
))->save();

$installer->endSetup();