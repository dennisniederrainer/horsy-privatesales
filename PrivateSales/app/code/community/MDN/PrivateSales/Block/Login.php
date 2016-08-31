<?php

class MDN_PrivateSales_Block_Login extends Mage_Core_Block_Template
{
	/**
	 * Return submit url for submit to login or lost password
	 *
	 * @return unknown
	 */
	public function getSubmitUrl()
	{
		return $this->getUrl('PrivateSales/Restricted/Login', Mage::app()->getStore());
	}
	
	/**
	 * Return public url
	 *
	 */
	public function getPublicUrl()
	{
		return $this->getUrl(mage::getStoreConfig('privatesales/general/public_cms_page', Mage::app()->getStore()));		
	}
	
    /**
     * Retrieve username for form field
     *
     * @return string
     */
    public function getUsername()
    {
        if (-1 === $this->_username) {
            $this->_username = Mage::getSingleton('customer/session')->getUsername(true);
        }
        return $this->_username;
    }
    
    public function getCreateAccountUrl()
    {
    	return $this->getUrl('PrivateSales/Restricted/CreateAccount');
    }
}