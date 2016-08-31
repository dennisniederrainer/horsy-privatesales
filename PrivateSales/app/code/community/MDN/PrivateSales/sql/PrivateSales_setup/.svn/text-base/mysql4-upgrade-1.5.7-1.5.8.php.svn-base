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
$installer=$this;
/* @var $installer Mage_Eav_Model_Entity_Setup */
 
$installer->startSetup();

$installer->removeAttribute('catalog_product','ps_start_date');
$installer->removeAttribute('catalog_product','ps_end_date');
$installer->removeAttribute('catalog_product','ps_auto_change_status');
$installer->removeAttribute('catalog_product','ps_enable_time_limit');

$installer->addAttribute('catalog_product','flash_sale_id', array(
															'type' 		=> 'int',
															'visible' 	=> false,
															'label'		=> 'flash_sale_id',
															'required'  => false,
															'default'   => '0',
															'global'       => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,													        
															'backend'           => '',
													        'frontend'          => '',													        
													        'input'             => '',
													        'class'             => '',
													        'source'            => '',
													        'user_defined'      => false,
													        'searchable'        => false,
													        'filterable'        => false,
													        'comparable'        => false,
													        'visible_on_front'  => false,
															'is_configurable' => false,
													        'unique'            => false															
));


$installer->endSetup();