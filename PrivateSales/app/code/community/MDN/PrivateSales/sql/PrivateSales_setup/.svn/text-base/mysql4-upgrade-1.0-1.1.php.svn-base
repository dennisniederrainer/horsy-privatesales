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

//insert public cms page + link to all store views
$installer->run("

CREATE TABLE {$this->getTable('private_sales_invitation')}
(
`psi_id` INT NOT NULL AUTO_INCREMENT ,
`psi_code` VARCHAR( 10 ) NOT NULL ,
`psi_email` VARCHAR( 255 ) NOT NULL ,
`psi_from` VARCHAR( 100 ) NOT NULL ,
`psi_created_at` DATETIME NOT NULL ,
`psi_used` TINYINT NOT NULL DEFAULT  '0',
`psi_message` TEXT NOT NULL ,
PRIMARY KEY (  `psi_id` ) ,
INDEX (  `psi_code` )
);

");

$installer->endSetup();

