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
 * Adminhtml company grid block
 *
 * @category    Webinse
 * @package     Webinse_Company
 * @author      Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
class Webinse_Company_Block_Adminhtml_Company_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        
        $this->setId('CompanyGrid');
        $this->_controller = 'adminhtml_company';
        
		$this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('desc');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('webinse_company/company')->getCollection();
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {   
        $helper = Mage::helper('webinse_company');
        
        $this->addColumn('entity_id', array(
            'header'        => $helper->__('ID'),
            'align'         => 'right',
            'width'         => '20px',
            'filter_index'  => 'entity_id',
            'index'         => 'entity_id'
        ));

        $this->addColumn('name', array(
            'header'        => $helper->__('Name'),
            'align'         => 'left',
            'filter_index'  => 'name',
            'index'         => 'name',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('domains', array(
            'header'        => $helper->__('Domains'),
            'align'         => 'left',
            'filter_index'  => 'domains',
            'index'         => 'domains',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('contact_name', array(
            'header'        => $helper->__('Contact Name'),
            'align'         => 'left',
            'filter_index'  => 'contact_name',
            'index'         => 'contact_name',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('office_phone', array(
            'header'        => $helper->__('Office Phone'),
            'align'         => 'left',
            'filter_index'  => 'office_phone',
            'index'         => 'office_phone',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('mobile_phone', array(
            'header'        => $helper->__('Mobile Phone'),
            'align'         => 'left',
            'filter_index'  => 'mobile_phone',
            'index'         => 'mobile_phone',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('street', array(
            'header'        => $helper->__('Street'),
            'align'         => 'left',
            'filter_index'  => 'street',
            'index'         => 'street',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('city', array(
            'header'        => $helper->__('City'),
            'align'         => 'left',
            'filter_index'  => 'city',
            'index'         => 'city',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));

        $this->addColumn('state', array(
            'header'        => $helper->__('State'),
            'align'         => 'left',
            'filter_index'  => 'state',
            'index'         => 'state',
            'type'          => 'text',
            'truncate'      => 50,
            'escape'        => true,
        ));


        $this->addColumn('zip', array(
            'header'        => $helper->__('Zip'),
            'align'         => 'left',
            'filter_index'  => 'zip',
            'index'         => 'zip',
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
            'label'=> Mage::helper('webinse_company')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
            'confirm' => Mage::helper('webinse_company')->__('Are you sure?')
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
