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
class MDN_PrivateSales_Helper_Customer extends Mage_Core_Helper_Abstract
{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $customer
	 * @param unknown_type $decreaseValue
	 */
	public function decreaseCustomerInvitationCount($customer, $decreaseValue)
	{
		$value = $this->getCustomerMaxInvitation($customer);
		$value -= $decreaseValue;
		if ($value < 0)
			$value = 0;
		$customer->setinvitation_count($value)->save();
		return true;
	}

	/**
	 * Check if a customer is allowed to send the number of invitation
	 *
	 * @param unknown_type $customer
	 * @param unknown_type $invitationCount
	 */
	public function customerCanSendInvitationCount($customer, $invitationCount)
	{
		$max = $this->getCustomerMaxInvitation($customer);
		return ($max >= $invitationCount);
	}
	
	/**
	 * Return customer max invitation
	 *
	 * @param unknown_type $customer
	 * @return unknown
	 */
	public function getCustomerMaxInvitation($customer)
	{
		$max = $customer->getinvitation_count();
		if ($max == '')
		{
			$storeId = mage::app()->getStore()->getId();
			$max = mage::getStoreConfig('privatesales/invitations/customer_invitation_count', $storeId);
		}
			
		return $max;
	}
}