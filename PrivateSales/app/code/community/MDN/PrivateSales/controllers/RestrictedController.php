<?php
class MDN_PrivateSales_RestrictedController extends Mage_Core_Controller_Front_Action
{
	/**
	 * authentication form
	 *
	 */
	public function indexAction()
	{
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->renderLayout();		
	}
	
	/**
	 * receive post login data
	 *
	 */
	public function LoginAction()
	{
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session = $this->_getSession();

        if ($this->getRequest()->isPost()) {
        	
        	//if login mode
        	if ($this->getRequest()->getPost('lost_password') != '1')
        	{
	            $login = $this->getRequest()->getPost('login');
	            if (!empty($login['username']) && !empty($login['password'])) {
	                try 
	                {
	                    $session->login($login['username'], $login['password']);
	                }
	                catch (Exception $e) {
	                    switch ($e->getCode()) {
	                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
	                            $message = Mage::helper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.',
	                                Mage::helper('customer')->getEmailConfirmationUrl($login['username'])
	                            );
	                            break;
	                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
	                            $message = $e->getMessage();
	                            break;
	                        default:
	                            $message = $e->getMessage();
	                    }
	                    $session->addError($message);
	                    $session->setUsername($login['username']);
	                }
	            } else {
	                $session->addError($this->__('Login and password are required'));
	            }        		
		        $this->_loginPostRedirect();
        	}
        	else	//if lost password mode 
        	{
		        $email = $this->getRequest()->getPost('login');
		        $email = $email['username'];
				$redirectUrl = Mage::getUrl(mage::getStoreConfig('privatesales/general/redirect', Mage::app()->getStore()));
		        if ($email) {
		            if (!Zend_Validate::is($email, 'EmailAddress')) {
		                $this->_getSession()->setForgottenEmail($email);
		                $this->_getSession()->addError($this->__('Invalid email address'));
		                $this->getResponse()->setRedirect($redirectUrl);
		                return;
		            }
		            $customer = Mage::getModel('customer/customer')
		                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
		                ->loadByEmail($email);
		
		            if ($customer->getId()) {
		                try {
		                    $newPassword = $customer->generatePassword();
		                    $customer->changePassword($newPassword, false);
		                    $customer->sendPasswordReminderEmail();
		
		                    $this->_getSession()->addSuccess($this->__('A new password was sent'));
		
		                    $this->getResponse()->setRedirect($redirectUrl);
		                    return;
		                }
		                catch (Exception $e){
		                    $this->_getSession()->addError($e->getMessage());
		                }
		            }
		            else {
		                $this->_getSession()->addError($this->__('This email address was not found in our records'));
		                $this->_getSession()->setForgottenEmail($email);
		            }
		        } else {
		            $this->_getSession()->addError($this->__('Please enter your email.'));
		            $this->getResponse()->setRedirect($redirectUrl);
		            return;
		        }
		
		        $this->getResponse()->setRedirect($redirectUrl);
        	}
        	
        }

	}
	
	
    /**
     * Define target URL and redirect customer after logging in
     */
    protected function _loginPostRedirect()
    {
        $session = $this->_getSession();

        if (!$session->getBeforeAuthUrl() || $session->getBeforeAuthUrl() == Mage::getBaseUrl() ) {

            // Set default URL to redirect customer to
            $session->setBeforeAuthUrl(Mage::helper('customer')->getAccountUrl());

            // Redirect customer to the last page visited after logging in
            if ($session->isLoggedIn())
            {
                if (!Mage::getStoreConfigFlag('customer/startup/redirect_dashboard')) {
                    if ($referer = $this->getRequest()->getParam(Mage_Customer_Helper_Data::REFERER_QUERY_PARAM_NAME)) {
                        $referer = Mage::helper('core')->urlDecode($referer);
                        if ($this->_isUrlInternal($referer)) {
                            $session->setBeforeAuthUrl($referer);
                        }
                    }
                }
            } else {
				$url = Mage::getUrl(mage::getStoreConfig('privatesales/general/redirect', Mage::app()->getStore()));
                $session->setBeforeAuthUrl($url);
            }
        }

        $this->_redirectUrl($session->getBeforeAuthUrl(true));
    }

    /**
     * return customer session object
     *
     * @return unknown
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }
    
    /**
     * Display page to create account
     *
     */
    public function CreateAccountAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->renderLayout();	   	
    }
    
    /**
     * Create account
     *
     */
    public function SubmitAccountAction()
    {
    	try 
    	{
    		$activationCode = $this->getRequest()->getPost('activation_code');
    		$email = $this->getRequest()->getPost('email');
			$firstName = $this->getRequest()->getPost('firstname');
			$lastName = $this->getRequest()->getPost('lastname');
    		$password = $this->getRequest()->getPost('password');
    		$helper = mage::helper('PrivateSales');
			
    		//check activation code
			if (mage::helper('PrivateSales')->requireActivationCode())
			{
				if (!$helper->checkActivationCode($email, $activationCode))
					throw new Exception('Activation code invalid');    		
			}
				
			//Create customer
			$customer = mage::getModel('customer/customer')
							->setemail($email)
							->setfirstname($firstName)
							->setlastname($lastName)
							->setpassword($password);
			$errors = $customer->validate();

			//check data
			if ($errors != true)
				throw new Exception(implode(', ', $errors));
				
			//save and log in
			$customer->save();
			$customer->sendNewAccountEmail();
			$this->_getSession()->setCustomerAsLoggedIn($customer);
			$helper->storeAccountCreation($email);
			
			//confirm and redirect to customer account
    		$this->_getSession()->addSuccess('Account successfully created');
    		$this->_redirect('customer/account/index');
    	}
    	catch (Exception $ex)
    	{
    		$this->_getSession()->addError($ex->getMessage());
    		$this->_redirect('PrivateSales/Restricted/CreateAccount');
    	}
    }

}