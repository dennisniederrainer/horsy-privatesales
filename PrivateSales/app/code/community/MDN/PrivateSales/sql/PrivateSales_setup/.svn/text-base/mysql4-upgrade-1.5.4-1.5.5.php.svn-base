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

$installer->run("

CREATE TABLE {$this->getTable('private_sales_flash_sales')}
(
`fs_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fs_name` VARCHAR( 255 ) NOT NULL ,
`fs_start_date` DATETIME NOT NULL ,
`fs_end_date` DATETIME NOT NULL ,
`fs_description` TEXT NOT NULL ,
`fs_category_id` INT NOT NULL
) ENGINE = INNODB;

");

$installer->endSetup();

