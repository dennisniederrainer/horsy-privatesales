<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright  Copyright (c) 2009 Maison du Logiciel (http://www.maisondulogiciel.com)
 * @author : Olivier ZIMMERMANN
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MDN_PrivateSales_Model_FlashSales extends Mage_Core_Model_Abstract
{
	/**
	 * Constructor
	 *
	 */
	public function _construct()
	{
		parent::_construct();
		$this->_init('PrivateSales/FlashSales');
	}	
	
	/**
	 * extract time from date to use it with varien form... thank you varien !
	 */
    protected function _afterLoad()
    {
		
		$tStart = explode(' ', $this->getfs_start_date());
		$tEnd = explode(' ', $this->getfs_end_date());
		if (count($tStart) > 1)
			$this->setfs_start_time(str_replace(':', ',', $tStart[1]));
		if (count($tEnd) > 1)
			$this->setfs_end_time(str_replace(':', ',', $tEnd[1]));
		
        return parent::_afterLoad();
    }
	
	protected function _afterSave()
	{
        parent::_afterSave();
		$this->updateLinkedProducts();
		return $this;
	}
	
	/**
	 * Return picture url (should be in helper)
	 */
	public function getPictureUrl()
	{
		return Mage::getBaseUrl('media').$this->getfs_picture();
	}
	
	/**
	 * Associate flash sale to products
	 */
	public function updateLinkedProducts()
	{
		$this->getResource()->updateLinkedProducts($this->getId(), $this->getfs_category_id());
	}
	
	/**
	 * Check if flash sale is active
	 */
	public function isActive()
	{
		if ($this->getfs_enabled() == 0)
			return false;
			
		$currentTimeStamp = Mage::getModel('core/date')->timestamp();
		$startTimeStamp = strtotime($this->getfs_start_date());
		$endTimeStamp = strtotime($this->getfs_end_date());

		if (($currentTimeStamp > $startTimeStamp) && ($currentTimeStamp < $endTimeStamp))
			return true;
		else
			return false;
	}

        public function willBeActive(){

                if ($this->getfs_enabled() == 0)
			return false;

		$currentTimeStamp = Mage::getModel('core/date')->timestamp();
		$startTimeStamp = strtotime($this->getfs_start_date());
		$endTimeStamp = strtotime($this->getfs_end_date());

		if ($currentTimeStamp < $endTimeStamp)
			return true;
		else
			return false;
        }
	
	/**
	 * return true if end date is past
	 */
	public function isComplete()
	{
		$currentTimestamp = Mage::getModel('core/date')->timestamp();
		$endTimeStamp = strtotime($this->getfs_end_date());
		if ($currentTimestamp > $endTimeStamp)
			return true;
		else
			return false;
	}
	
	/**
	 * Return category url
	 */
	public function getLandingUrl()
	{
		$category = mage::getModel('catalog/category')->load($this->getfs_category_id());
		$url = mage::helper('catalog/category')->getCategoryUrl($category);
		return $url;
	}

	
}