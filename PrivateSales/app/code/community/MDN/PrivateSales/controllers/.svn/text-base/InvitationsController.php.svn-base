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
//Controlleur pour la gestion des contacts
class MDN_PrivateSales_InvitationsController extends Mage_Adminhtml_Controller_Action
{

	public function indexAction()
    {
    	$this->loadLayout();
        $this->renderLayout();
    }
    
    /**
     * Create invitations
     *
     */
    public function CreateAction()
    {

    	try 
    	{
    		$from = $this->getRequest()->getPost('from');
    		$msg = $this->getRequest()->getPost('msg');
    		$emails = $this->getRequest()->getPost('emails');
    		$store = $this->getRequest()->getPost('store');
    		
    		$t_mails = explode(';', $emails);
    		foreach ($t_mails as $email)
    		{
    			$email = trim($email);
    			if ($email == '')
    				continue;
    				
    			mage::getModel('PrivateSales/Invitation')
    							->setpsi_email($email)
    							->setpsi_from($from)
    							->setpsi_message($msg)
    							->setpsi_store($store)
    							->fillAndSave();
    		}
    		
			Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Invitations successfully sent'));
    	}
    	catch (Exception $ex)
    	{
    		
			Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured : ').$ex->getMessage());
    	}

    	$this->_redirect('PrivateSales/Invitations');
    }
    
    /**
     * Ajax grid
     *
     */
    public function GridAction()
    {
    	$this->loadLayout();
		$Block = $this->getLayout()->createBlock('PrivateSales/Admin_Invitations_Grid');
        $this->getResponse()->setBody($Block->toHtml());
    }
    
    /**
     * Delete invitation
     *
     */
    public function DeleteAction()
    {
    	$psiId = $this->getRequest()->getParam('psi_id');
    	$invitation = mage::getModel('PrivateSales/Invitation')->load($psiId)->delete();
    	
    	Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Invitation deleted'));
    	$this->_redirect('PrivateSales/Invitations');
    	
    }
}