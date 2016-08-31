<?php

class MDN_PrivateSales_Block_Admin_FlashSales_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * 
     *
     */
    public function __construct()
    {
		$this->_blockGroup = 'PrivateSales';
		$this->_objectId = 'flashsales_id';
        $this->_controller = 'Admin_FlashSales';
        parent::__construct();
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
		$editLabel = Mage::helper('PrivateSales')->__('Edit Flash Sale');
		$addLabel  = Mage::helper('core')->__('New Flash Sale');
		
        return (Mage::registry('current_flash_sale') === null ? $addLabel : $editLabel);
    }
	
    public function getBackUrl()
    {
        return $this->getUrl('*/*/List');
    }

}
