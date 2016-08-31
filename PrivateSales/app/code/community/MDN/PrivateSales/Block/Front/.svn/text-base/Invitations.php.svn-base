<?php

class MDN_PrivateSales_Block_Front_Invitations extends Mage_Core_Block_Template
{
	/**
	 * return remaining invitations count
	 *
	 */
	public function getInvitationsCount()
	{
		$customer = Mage::getSingleton('customer/session')->getCustomer();
		return mage::helper('PrivateSales/Customer')->getCustomerMaxInvitation($customer);
	}

	/**
	 * Submit url
	 *
	 * @return unknown
	 */
	public function getSubmitUrl()
	{
		return $this->getUrl('PrivateSales/Front/SubmitInvitation');
	}
	
	/**
	 * return true if customer invitation is enabled
	 *
	 * @return unknown
	 */
	public function invitationsEnabled()
	{
		$storeId = mage::app()->getStore()->getId();
		return (mage::getStoreConfig('privatesales/invitations/enable_customer_invitation', $storeId) == 1);		
	}
	
	public function getCustomerName()
	{
		return Mage::getSingleton('customer/session')->getCustomer()->getName();
	}
}