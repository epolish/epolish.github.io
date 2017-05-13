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
 * Adminhtml company grid block
 *
 * @category    Webinse
 * @package     Webinse_Discount
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Discount_Block_Adminhtml_Discount_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        
        $this->setId('DiscountGrid');
        $this->_controller = 'adminhtml_discount';
        
		$this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('webinse_discount/discount')->getCollection();
        $entityTypeId = Mage::getModel('eav/entity')->setType('catalog_product')->getTypeId();
        $prodNameAttrId = Mage::getModel('eav/entity_attribute')->loadByCode($entityTypeId, 'name')->getAttributeId();

        $collection->getSelect()
            ->joinLeft(
                array('prod' => 'catalog_product_entity'),
                'prod.entity_id = main_table.product_id',
                array('sku')
            )
            ->joinLeft(
                array('cpev' => 'catalog_product_entity_varchar'),
                'cpev.entity_id = prod.entity_id AND cpev.attribute_id = '.$prodNameAttrId.'',
                array('name' => 'value')
            );

        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {   
        $helper = Mage::helper('webinse_discount');

        $this->addColumn('entity_id', array(
            'header'        => $helper->__('ID'),
            'align'         => 'right',
            'width'         => '20px',
            'filter_index'  => 'entity_id',
            'index'         => 'entity_id'
        ));

        $this->addColumn('name', array(
            'header'        => $helper->__('Product Name'),
            'align'         => 'left',
            'filter_index'  => 'name',
            'index'         => 'name',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('sku', array(
            'header'        => $helper->__('Product SKU'),
            'align'         => 'left',
            'filter_index'  => 'sku',
            'index'         => 'sku',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('qty_products', array(
            'header'        => $helper->__('Qty'),
            'align'         => 'left',
            'filter_index'  => 'qty_products',
            'index'         => 'qty_products',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('item_price', array(
            'header'        => $helper->__('Item Price'),
            'align'         => 'left',
            'filter_index'  => 'item_price',
            'index'         => 'item_price',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('subtotal', array(
            'header'        => $helper->__('Subtotal'),
            'align'         => 'left',
            'filter_index'  => 'subtotal',
            'index'         => 'subtotal',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('webinse_discount')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('webinse_discount')->__('Are you sure?')
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getId(),
        ));
    }
	
	public function getGridUrl()
	{
		return $this->getUrl('*/*/grid', array('_current' => true));
	}

}
