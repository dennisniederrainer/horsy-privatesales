<?php

class MDN_PrivateSales_Block_Admin_Invitations_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('InvitationsGrid');
        $this->_parentTemplate = $this->getTemplate();
        $this->setEmptyText(mage::helper('PrivateSales')->__('No items'));
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Charge la collection des devis
     *
     * @return unknown
     */
    protected function _prepareCollection()
    {		            
		//charge les devis avec une jointure sur les clients (ma premiere jointure magento :) :) :) :)
		$collection = mage::getModel('PrivateSales/Invitation')
						->getCollection();
        $this->setDefaultSort('psi_created_at', 'DESC');
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
                        
        $this->addColumn('psi_created_at', array(
            'header'=> Mage::helper('PrivateSales')->__('Date'),
            'index' => 'psi_created_at',
            'type' => 'datetime'
        ));
        
        $this->addColumn('psi_from', array(
            'header'=> Mage::helper('PrivateSales')->__('From'),
            'index' => 'psi_from'
        ));
        
        $this->addColumn('psi_email', array(
            'header'=> Mage::helper('PrivateSales')->__('To'),
            'index' => 'psi_email'
        ));
        
        $this->addColumn('psi_code', array(
            'header'=> Mage::helper('PrivateSales')->__('Code'),
            'index' => 'psi_code'
        ));

        $this->addColumn('psi_used', array(
            'header'=> Mage::helper('PrivateSales')->__('Used ?'),
            'index' => 'psi_used',
             'type' => 'options',
            'options' => array(
                '1' => Mage::helper('catalog')->__('Yes'),
                '0' => Mage::helper('catalog')->__('No'),
            ),
            'align' => 'center'
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
                    'url'     => array('base'=>'PrivateSales/Invitations/Delete/psi_id/$psi_id'),
                    'field'   => 'psi_id'
                )
            )
        ));
        

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/Grid', array('_current'=>true));
    }

    public function getGridParentHtml()
    {
        $templateName = Mage::getDesign()->getTemplateFilename($this->_parentTemplate, array('_relative'=>true));
        return $this->fetchView($templateName);
    }
       
}
