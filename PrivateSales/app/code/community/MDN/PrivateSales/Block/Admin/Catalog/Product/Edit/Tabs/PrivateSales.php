<?php

class MDN_PrivateSales_Block_Admin_Catalog_Product_Edit_Tabs_PrivateSales extends Mage_Adminhtml_Block_Widget_Form
{
	protected $_flashSale = null;

	public function hasFlashSale()
	{
        $product = Mage::registry('product');
		return ($product->getflash_sale_id() > 0);
	}
	
	public function getFlashSale()
	{
		if ($this->_flashSale == null)
		{
			$product = Mage::registry('product');
			$id = $product->getflash_sale_id();
			$this->_flashSale = mage::getModel('PrivateSales/FlashSales')->load($id);
		}
		return $this->_flashSale;
	}
	
	public function getFlashSaleUrl()
	{
		return mage::helper('adminhtml')->getUrl('PrivateSales/FlashSales/Edit', array('fs_id' => $this->getFlashSale()->getId()));
	}
}