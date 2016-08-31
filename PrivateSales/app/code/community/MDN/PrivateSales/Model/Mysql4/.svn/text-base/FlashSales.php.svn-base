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
class MDN_PrivateSales_Model_Mysql4_FlashSales extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('PrivateSales/FlashSales', 'fs_id');
    }

    /**
     * Associate flash sale to products
     */
    public function updateLinkedProducts($flashSaleId, $categoryId) {

        //create an array with category ids
        $categoryIds = $this->getCategoryIds($categoryId);

        //remove associated products
        $write = Mage::getSingleton('core/resource')->getConnection('admin_write');
        $tableName = Mage::getConfig()->getTablePrefix() . 'catalog_product_entity_int';
        $flashSaleIdAttributeId = mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', 'flash_sale_id')->getId();

        /*$write->delete($tableName,
                'attribute_id=' . $flashSaleIdAttributeId . ' and value=' . $flashSaleId);*/

        /*echo $flashSaleIdAttributeId;
        die();*/

        $sql_delete = 'DELETE FROM '.$tableName.'
                WHERE attribute_id = "'.$flashSaleIdAttributeId.'"
                AND value="'.$flashSaleId.'"';

        $write->query($sql_delete);

        // retrieve informations
        $sql = 'SELECT
                        ' . Mage::getModel('eav/entity_type')->loadByCode('catalog_product')->getId() . ' AS entity_type_id,
                        ' . $flashSaleIdAttributeId . ' AS attribute_id,
                        0 AS store_id,
                        product_id AS entity_id,
                        ' . $flashSaleId . ' AS value
                FROM
                        ' . Mage::getConfig()->getTablePrefix() . 'catalog_category_product
                WHERE
                        category_id in (' . implode(',', $categoryIds) . ')';

        $read = Mage::getSingleton('core/resource')->getConnection('admin_read');

        $res = $read->fetchAll($sql);

        // TODO : use prepare request
        foreach($res as $k){

            $sql = 'SELECT *
                    FROM '.$tableName.'
                    WHERE entity_id = '.$k['entity_id'].'
                    AND attribute_id = '.$flashSaleIdAttributeId;

            $relations = $read->fetchAll($sql);

            if(count($relations) > 0){
                //update
                $sql_update = 'UPDATE '.$tableName.'
                               SET value = '.$flashSaleId.'
                               WHERE entity_id = '.$k['entity_id'].'
                               AND attribute_id = '.$flashSaleIdAttributeId;

                $write->query($sql_update);

            }else{
                //insert
                $sql_insert = 'INSERT INTO '.$tableName.'
                                (entity_type_id, attribute_id, store_id, entity_id, value)
                                VALUES ("'.$k['entity_type_id'].'","'.$k['attribute_id'].'","'.$k['store_id'].'","'.$k['entity_id'].'","'.$k['value'].'")';

                $write->query($sql_insert);
            }

        }

        //associate products
        /*$sql = "
				insert into " . $tableName . "
					(entity_type_id,
					attribute_id,
					store_id,
					entity_id,
					value)
				select
					" . Mage::getModel('eav/entity_type')->loadByCode('catalog_product')->getId() . ",
					" . $flashSaleIdAttributeId . ",
					0,
					product_id,
					" . $flashSaleId . "
				from
					" . Mage::getConfig()->getTablePrefix() . "catalog_category_product
				where
					category_id in (" . implode(',', $categoryIds) . ");
				";


        $write->query($sql);*/

    }

    /**
     *
     */
    protected function getCategoryIds($parentId) {

        $read = Mage::getSingleton('core/resource')->getConnection('admin_read');
        $model = mage::getResourceModel('catalog/category');
        $tableName = Mage::getSingleton('core/resource')->getTableName('catalog/category');
        $select = $read->select()->from($tableName)->where("path like '%?/%'", (int) $parentId);
        $ids = $read->fetchCol($select);
        $ids[] = $parentId;

        return $ids;
    }

}

?>