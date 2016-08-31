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
class MDN_PrivateSales_Helper_FlashSales extends Mage_Core_Helper_Abstract
{

	public function getImageDirectory()
	{
		// $path = Mage::getStoreConfig('system/filesystem/media').DS.$this->getImageDirectoryName().DS;
		$path = Mage::getBaseDir('media') . DS . $this->getImageDirectoryName().DS;
		return $path;
	}

	public function getImageDirectoryName()
	{
		return 'flash_sales';
	}

}
