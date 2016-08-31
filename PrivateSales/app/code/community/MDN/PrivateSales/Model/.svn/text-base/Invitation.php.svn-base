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
class MDN_PrivateSales_Model_Invitation extends Mage_Core_Model_Abstract
{
	/**
	 * Constructor
	 *
	 */
	public function _construct()
	{
		parent::_construct();
		$this->_init('PrivateSales/Invitation');
	}	
	
	/**
	 * Fill information (code), save, send email
	 *
	 */
	public function fillAndSave()
	{
		//add code
		$code = mage::helper('PrivateSales')->generateCode();
		$this->setpsi_code($code);
		
		//define default values and save
		$this->setpsi_used(0);
		$this->setpsi_created_at(date('Y-m-d h:i'));
		$this->save();
		
		//send email
		$this->sendEmail();
		
	}
	
	/**
	 * Send email for invitation
	 *
	 */
	public function sendEmail()
	{
		$translate = Mage::getSingleton('core/translate');
        $translate->setTranslateInline(false);

        $templateId = Mage::getStoreConfig('privatesales/invitations/email_template', $this->getpsi_store());
        $identityId = Mage::getStoreConfig('privatesales/invitations/email_identity', $this->getpsi_store());
        
        //define datas
        $data = array
        	(
        		'from'=>$this->getpsi_from(),
        		'code'=>$this->getpsi_code(),
        		'message'=>$this->getpsi_message()
        	);
        
        //send email
       if(!empty($templateId))
	        Mage::getModel('core/email_template')
	            ->setDesignConfig(array('area'=>'frontend', 'store'=>$this->getpsi_store()))
	            ->sendTransactional(
	                $templateId,
	                $identityId,
	                $this->getpsi_email(),
	                '',
	                $data,
	                null);
	    else
	    	throw new Exception('Template Transactionnel Empty');
                    
        $translate->setTranslateInline(true);

        return $this;
	}
}