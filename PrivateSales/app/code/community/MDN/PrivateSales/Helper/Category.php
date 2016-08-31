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
class MDN_PrivateSales_Helper_Category extends Mage_Core_Helper_Abstract
{

	/**
	 * Return categories
	 */
	public function getCategories()
	{
		$categories = array();	
		$rootCategory = mage::getModel('catalog/category')->load(Mage::getStoreConfig('privatesales/general/root_category'));
		$this->parseCategoryRecursive($rootCategory, $categories, 0);
		
		return $categories;
	}
	
	public function geAllOptions()
	{
		$retour = array();
		
		foreach($this->getCategories() as $cat)
		{
			$indent = '';
			for($i=0;$i<$cat->getDepth();$i++)
				$indent .= '|--- ';
			$retour[$cat->getId()] = $indent.$cat->getName();
		}
		
		return $retour;
	}
	
	/**
	 * Parse categories recursively and fill flat array
	 */
	protected function parseCategoryRecursive($currentCategory, &$categories, $depth)
	{
		//get sub categories
		$children = $currentCategory->getChildren(true);
		$children = explode(',', $children);
		foreach($children as $childId)
		{
			if (!$childId)
				continue;
				
			$category = mage::getModel('catalog/category')->load($childId);
			$category->setDepth($depth);
			$categories[] = $category;
			$this->parseCategoryRecursive($category, $categories, $depth + 1);
		}
	}
	
        public function isCategoriesLinkedToFlashsale($categoryIds) {
            $sql = 'SELECT fs_id FROM private_sales_flash_sales ' .
                'WHERE fs_category_id in (' . implode(',', $categoryIds) . ')';
            $read = Mage::getSingleton('core/resource')->getConnection('admin_read');
            $results = $read->fetchAll($sql);
            
            Mage::log(implode(',', $categoryIds) . " RESULTCOUNT: " . count($results), null, 'CATEGORYHELPER.log');

            return (count($results) > 0);
        }
}