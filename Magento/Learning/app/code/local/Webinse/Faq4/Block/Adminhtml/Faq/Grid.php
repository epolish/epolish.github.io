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
 * Adminhtml faq grid block
 *
 * @category    Webinse
 * @package     Webinse_Faq4
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Faq4_Block_Adminhtml_Faq_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();

        $settings = array(
            'id' => 'FAQGrid',
            'useAjax' => true,
            'defaultSort' => 'entity_id',
            'defaultDir' => 'desc',
        );
        
        $this->setId($settings['id']);
        $this->_controller = 'adminhtml_faq';
        
        $this->setUseAjax($settings['useAjax']);
        $this->setDefaultSort($settings['defaultSort']);
        $this->setDefaultDir($settings['defaultDir']);
        
        Mage::getSingleton('core/session')->setGridSettings($settings);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('webinse_faq4/faq')->getCollection();
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }

    /**
     * Configuration of grid
     */
    protected function _prepareColumns()
    {   
        $helper = Mage::helper('webinse_faq4');
        
        $this->addColumn('entity_id', array(
            'header'        => $helper->__('ID'),
            'align'         => 'right',
            'width'         => '20px',
            'filter_index'  => 'entity_id',
            'index'         => 'entity_id'
        ));
    
        $this->addColumn('question', array(
            'header'        => $helper->__('Question'),
            'align'         => 'left',
            'filter_index'  => 'question',
            'index'         => 'question',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));
        
        $this->addColumn('answer', array(
            'header'        => $helper->__('Answer'),
            'align'         => 'left',
            'filter_index'  => 'answer',
            'index'         => 'answer',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));
    
        $this->addColumn('action', array(
            'header'    => $helper->__('Action'),
            'width'     => '50px',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'  => $helper->__('Edit'),
                    'url'      => array(
                        'base' => '*/*/edit',
                    ),
                    'field'    => 'id'
                )
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'entity_id',
        ));
        
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getId(),
        ));
    }

}
