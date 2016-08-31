<?php



class MDN_PrivateSales_Block_Front_FlashSales_Slider extends Mage_Core_Block_Template
{
	private $_height = 100;
	private $_width = 300;
	
	public function setHeight($value)
	{	
		$this->_height = $value;
		return $this;
	}
	
	public function getHeight()
	{	
		return $this->_height;
	}
	
	public function setWidth($value)
	{	
		$this->_width = $value;
		return $this;
	}
	
	public function getWidth()
	{	
		return $this->_width;
	}
	
	public function getActiveFlashSales()
	{
		$collection = mage::getModel('PrivateSales/FlashSales')
                                    ->getCollection()
                                    ->addFieldToFilter('fs_enabled', '1')
                                    /*->addFieldToFilter('fs_start_date',array(
                                        'to' => date('Y-m-d H:i:s'),
                                        'date' => true
                                    ))*/
                                    ->addFieldToFilter('fs_end_date', array(
                                        'from' => date('Y-m-d H:i:s'),
                                        'date' => true
                                    ));
							
		return $collection;
	}

}
