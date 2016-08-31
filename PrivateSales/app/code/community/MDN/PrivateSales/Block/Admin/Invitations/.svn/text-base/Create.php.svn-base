<?php

class MDN_PrivateSales_Block_Admin_Invitations_Create extends Mage_Adminhtml_Block_Widget_Form
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Form submit url
	 *
	 * @return unknown
	 */
	public function getSubmitUrl()
	{
		return $this->getUrl('PrivateSales/Invitations/Create');
	}
	
	/**
	 * Return a combobox with every store for which private sales is enabled
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	public function getStoresAsCombo($name)
	{
		$retour = '<select name="'.$name.'" id="'.$name.'">';
		
		$collection = mage::getModel('core/store')->getCollection();
		foreach ($collection as $item)
		{
			$enable = mage::getStoreConfig('privatesales/general/enable', $item);
			if ($enable)
				$retour .= '<option value="'.$item->getstore_id().'">'.$item->getname().'</option>';
		}	
		
		$retour .= '</select>';
		return $retour;
	}
	
}