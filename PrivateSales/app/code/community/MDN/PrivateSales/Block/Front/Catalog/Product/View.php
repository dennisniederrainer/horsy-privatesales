<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2009 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class MDN_PrivateSales_Block_Front_Catalog_Product_View extends Mage_Catalog_Block_Product_View
{
	private $_flashSale = null;

    protected $weekDays = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
    protected $monthes = array('1' => 'Januar', '2' => 'Februar', '3' => 'März', '4' => 'April', '5' => 'Mai', '6' => 'Juni', '7' => 'Juli', '8' => 'August', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Dezember');

	/**
	 * Return flash sale associated to product
	 */
	public function getFlashSale()
	{
		if ($this->_flashSale == null)
		{
			$_id = $this->getProduct()->getflash_sale_id();
			$this->_flashSale = mage::getModel('PrivateSales/FlashSales')->load($_id);
		}
		return $this->_flashSale;
	}

	// Horsebrands: Check if current Product is assigned to the Outlet Category
	public function isProductAssignedToOutletCategory() {
		$outletCategoryId = 258;

		if(in_array($outletCategoryId, $this->getProduct()->getCategoryIds())) {
			return true;
		}

		return false;
	}

	// Horsebrands: Check if current Product is assigned to the Outlet Category
	public function isFlashSaleCategory() {
		$outletCategoryId = 258;
		$giftcardCategoryId = 956;
		$categoryIds = $this->getProduct()->getCategoryIds();

		if(in_array($outletCategoryId, $categoryIds) 
			|| in_array($giftcardCategoryId, $categoryIds)) {
			return false;
		}

		return true;
	}

	public function isShopProduct() {
		return Mage::helper('warehouse')->hasCategoriesWithoutFlashsaleReferenceByProduct($this->getProduct());
	}

    public function getFsEndDate()
    {
        $endDate = Mage::getModel('core/date')->timestamp(strtotime($this->_flashSale->getfs_end_date()));
        return $this->dateToFormattedString($endDate);
    }

    private function dateToFormattedString($date)
    {
        $dateString = "";
        $now = time();

        $dateArr = getdate($date);
        $nowArr = getdate($now);

        if($this->isToday($date))
        {
            $dateString .= "heute, ".$dateArr['hours']." Uhr";
        }
        elseif($this->isTomorrow($date))
        {
            $dateString .= "morgen, ".$dateArr['hours']." Uhr";
        }
        else
        {
			/* @dennis 2014-02-21
			 *  Nach dem Tag (mday) einen (String)Punkt angefügt
			 */
            $dateString .= $this->weekDays[$dateArr['wday']].", ".$dateArr['mday'].". ".$this->monthes[$dateArr['mon']].", ".$dateArr['hours']." Uhr";
        }

        return $dateString;
    }

    private function isToday($date)
    {
        return date('Ymd') == date('Ymd', $date);
    }

    private function isTomorrow($date)
    {
        $today = date('Ymd', $date);
        $tomorrow = date('Ymd', strtotime('tomorrow'));
        return $today == $tomorrow;
    }
		
	/**
	 * Return caption for limit date
	 *
	 */
	public function getCaption()
	{
		if (!$this->getFlashSale()->isComplete())
		{
			$currentTimestamp = Mage::getModel('core/date')->timestamp();
			$startTimestamp = strtotime($this->getFlashSale()->getfs_start_date());
			$endTimestamp = strtotime($this->getFlashSale()->getfs_end_date());
			
			if ($startTimestamp > $currentTimestamp)
				return $this->__('Starts in ');
			else 
				return $this->__('Ends in ');
		}
		else
			return $this->__('Flash sales ended');
	}
	
	/**
	 * return private sales end time
	 *
	 */
	public function getLimitDate()
	{
		//uncomment to test counter zero callback
		//return date('Y-m-d H:i:s', time() + 3600 + 3600 + 120);
		
		$currentTimestamp = Mage::getModel('core/date')->timestamp();
		$startTimestamp = strtotime($this->getFlashSale()->getfs_start_date());
		$endTimestamp = strtotime($this->getFlashSale()->getfs_end_date());
		if ($startTimestamp > $currentTimestamp)
			return $this->getFlashSale()->getfs_start_date();
		else 
			return $this->getFlashSale()->getfs_end_date();
	}
	
	/**
	 * return true if product manage time limit
	 *
	 */
	public function hasFlashSale()
	{
		return ($this->getProduct()->getflash_sale_id() > 0);		
	}
	
	/**
	 * Return div style for add to cart div
	 */
	public function getStyleForAddToCartDiv()
	{
		if ($this->hasFlashSale())
		{
			if ($this->getFlashSale()->isActive())
				return '';
			else 
				return 'display: none';
				
		}
		else 
			return '';
	}
	
	/**
	 * return js function to call once counter reach 0
	 *
	 * @return unknown
	 */
	public function getActionWhenCounterReachZero()
	{
		$currentTimestamp = Mage::getModel('core/date')->timestamp();
		$startTimestamp = strtotime($this->getFlashSale()->getfs_start_date());
		$endTimestamp = strtotime($this->getFlashSale()->getfs_end_date());
		
		if ($startTimestamp > $currentTimestamp)
			return 'displayCartDiv();';
		else 
			return 'hideCartDiv();';
	}
        
}
