<?php
class MDN_PrivateSales_FrontController extends Mage_Core_Controller_Front_Action
{
	/**
	 * Invitations tab in customer account (front)
	 *
	 */
	public function InvitationsAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
	
	/**
	 * Send invitations
	 *
	 */
	public function SubmitInvitationAction()
	{
		try 
    	{
    		$customer = Mage::getSingleton('customer/session')->getCustomer();
    		$from = $customer->getName();
    		$msg = $this->getRequest()->getPost('msg');
    		$emails = $this->getRequest()->getPost('emails');
    		$store = mage::app()->getStore()->getId();
    		
    		//format emails value
    		$emails = str_replace(';', ',', $emails);
    		$emails = str_replace("\n", ',', $emails);
    		$emails = str_replace("\r", '', $emails);
    		$t_mails = explode(',', $emails);

    		//check for invitation count
    		if (!mage::helper('PrivateSales/Customer')->customerCanSendInvitationCount($customer, count($t_mails)))
    			throw new Exception($this->__('You can not send more than %d invitations', mage::helper('PrivateSales/Customer')->getCustomerMaxInvitation($customer)));

    		//send emails
    		$sentEmails = 0;
    		foreach ($t_mails as $email)
    		{
    			$email = trim($email);
    			if ($email == '')
    				continue;
    			
    			//send email
    			mage::getModel('PrivateSales/Invitation')
    							->setpsi_email($email)
    							->setpsi_from($from)
    							->setpsi_message($msg)
    							->setpsi_store($store)
    							->fillAndSave();
    			
    			$sentEmails++;				
    		}
    		
   			//decrease invitation count
   			mage::helper('PrivateSales/Customer')->decreaseCustomerInvitationCount($customer, $sentEmails);
   			
   			//confirm
			Mage::getSingleton('customer/session')->addSuccess($this->__('Emails successfully sent'));
   			
    	}
    	catch (Exception $ex)
    	{
			Mage::getSingleton('customer/session')->addError($ex->getMessage());
    	}

    	$this->loadLayout();
        $this->_initLayoutMessages('customer/session');    	
    	$this->renderLayout();
	}
}