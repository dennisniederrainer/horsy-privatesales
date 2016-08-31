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

INSERT INTO {$this->getTable('cms_page')} (`title`, `root_template`, `meta_keywords`, `meta_description`, `identifier`, `content`, `creation_time`, `update_time`, `is_active`, `sort_order`, `layout_update_xml`, `custom_theme`, `custom_theme_from`, `custom_theme_to`) VALUES 
('Public Page', 'empty', '', '', 'public', 'Dear visitor,<br>our website is restricted to authenticated customers.<br>To get an account, please contact us at myemail@mydomain.com<br>Regards', '2010-01-14 19:27:16', '2010-01-14 19:27:16', 1, 0, '', '', NULL, NULL);

INSERT INTO {$this->getTable('cms_page_store')} (page_id, store_id)
select page_id, 0
from  {$this->getTable('cms_page')}
where identifier = 'public';


");

$installer->endSetup();