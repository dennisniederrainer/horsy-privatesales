<?php

class MDN_PrivateSales_Block_Admin_Catalog_Product_Edit_Tabs extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs
{
	/**
	 * Add private sales tab in product sheet
	 *
	 * @return unknown
	 */
	protected function _prepareLayout()
    {
    	parent::_prepareLayout();
    	
        $product = $this->getProduct();
		if ($product->getId())
		{
            $this->addTab('flashsales', array(
                'label'     => Mage::helper('PrivateSales')->__('Flash sale'),
                'content'   => $this->getLayout()->createBlock('PrivateSales/Admin_Catalog_Product_Edit_Tabs_PrivateSales')
									->setTemplate('PrivateSales/Catalog/Product/Edit/Tabs/FlashSale.phtml')
									->toHtml()
            ));
		}
		
		return $this;
    }
}