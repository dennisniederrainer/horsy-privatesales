<?php

class MDN_PrivateSales_Model_System_Config_Source_ChangeStatusMode extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
            	array(
                    'value' => 'visibility',
                    'label' => Mage::helper('PrivateSales')->__('Visibility'),
                ),
            	array(
                    'value' => 'stock_status',
                    'label' => Mage::helper('PrivateSales')->__('Stock status'),
                )
            );
        }
        return $this->_options;
    }
    
	public function toOptionArray()
	{
		return $this->getAllOptions();
	}
}