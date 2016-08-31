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

insert into {$this->getTable('core_email_template')} 
(template_code, template_text, template_type, template_subject)
values
(
	'Private Sales Invitation',
	'Hello <br /> {{var from}} is glad to invite you to Private Sales.<br>You can create your account from <a href=\"{{store url=\"\"}}\">here</a> using invite code : {{var code}} <br> {{var message}}',
	2,
	'Private Sales Invitation'
);


");

$installer->endSetup();