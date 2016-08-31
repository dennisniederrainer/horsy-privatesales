<?php

class MDN_PrivateSales_Block_Admin_FlashSales_List extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('FlashSalesGrid');
        $this->_parentTemplate = $this->getTemplate();
        $this->setEmptyText(mage::helper('PrivateSales')->__('No items'));
        $this->setSaveParametersInSession(true);
    }

    /**
     * 
     *
     * @return unknown
     */
    protected function _prepareCollection()
    {		            
		$collection = mage::getModel('PrivateSales/FlashSales')
						->getCollection();
        $this->setDefaultSort('fs_created_at', 'DESC');
		$this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
   /**
     * Défini les colonnes du grid
     *
     * @return unknown
     */
    protected function _prepareColumns()
    {
                                
        $this->addColumn('fs_name', array(
            'header'=> Mage::helper('PrivateSales')->__('Name'),
            'index' => 'fs_name'
        ));
		
        $this->addColumn('fs_enabled', array(
            'header'=> Mage::helper('PrivateSales')->__('Enabled'),
            'index' => 'fs_enabled',
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center'
        ));

        // Horsebrands
        // actually the column setup was like:

        // $this->addColumn('fs_start_date', array(
        //     'header'=> Mage::helper('PrivateSales')->__('Starts at'),
        //     'index' => 'fs_start_date',
        //     'type' => 'datetime'
        // ));

        // but it is too confusing to see the date in localtime (CE(S)T) with GMT conversion (+2 hours)
        // so it will be displayed as a date with local format.
		
		$this->addColumn('fs_start_date', array(
            'header'=> Mage::helper('PrivateSales')->__('Starts at'),
            'index' => 'fs_start_date',
            'format' => Mage::app()->getLocale()
                ->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
            'type' => 'date'
			// 'type' => 'datetime'
        ));

		$this->addColumn('fs_end_date', array(
            'header'=> Mage::helper('PrivateSales')->__('Ends at'),
            'index' => 'fs_end_date',
            'format' => Mage::app()->getLocale()
                ->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM),
			'type' => 'date'
        ));

		
        $this->addColumn('action', array(
            'header'    => Mage::helper('PrivateSales')->__('Action'),
            'index'     => 'psi_id',
            'type'      => 'action',
            'filter'    => false,
            'sortable'  => false,
            'actions'   => array(
                array(
                    'caption' =>  Mage::helper('PrivateSales')->__('delete'),
                    'url'     => array('base'=>'PrivateSales/FlashSales/Delete/fs_id/$fs_id'),
                    'field'   => 'psi_id'
                )
            )
        ));
        

        return parent::_prepareColumns();
    }

    public function getGridParentHtml()
    {
        $templateName = Mage::getDesign()->getTemplateFilename($this->_parentTemplate, array('_relative'=>true));
        return $this->fetchView($templateName);
    }

	public function getNewSaleUrl()
	{
		return mage::helper('adminhtml')->getUrl('PrivateSales/FlashSales/Edit');
	}

    public function getRowUrl($row)
    {
    	return $this->getUrl('*/*/Edit', array('fs_id' => $row->getId()));
    }
	
}
