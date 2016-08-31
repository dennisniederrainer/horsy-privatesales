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
class MDN_PrivateSales_Model_Observer extends Mage_Core_Model_Abstract {

    /**
     * Check for private sales restricted access
     *
     * @param Varien_Event_Observer $observer
     * @return unknown
     */
    public function controller_action_predispatch(Varien_Event_Observer $observer) {
        $obj = $object = $observer->getEvent()->getcontroller_action();

        //leave function if we are in admin panel
        $designPackage = Mage::getSingleton('core/design_package');
        if ($designPackage->getArea() == 'adminhtml')
            return false;


        $redirect = mage::helper('PrivateSales')->checkForRedirect();
        if (($redirect != '') && ($redirect != false)) {

            if (count($redirect) >= 3) {
                $redirectUrl = $redirect[0].'/'. $redirect[1].'/'.$redirect[2];
            }else if (count($redirect) >= 2) {
                $redirectUrl = $redirect[0].'/'. $redirect[1];
            }else {
                $redirectUrl = $redirect[0].'/';
            }

            $redirectUrl = mage::getUrl($redirectUrl);

            mage::log('Redirect to ' . $redirectUrl, null, 'privatesales_redirect.log');
            header('Location: ' . $redirectUrl);
            exit;
        }
    }

    public function saveUpcomingFlashsales() {
        $upcomingflashsales = mage::getModel('PrivateSales/FlashSales')
                        ->getCollection()
                        ->addFieldToFilter('fs_end_date', array("gteq"=>now()))
                        ->addFieldToFilter('fs_enabled', array('eq' => '1'));

        $debug = '<h1>'.count($upcomingflashsales).' Flashsales wurden gespeichert</h1>';

        foreach ($upcomingflashsales as $fs) {
            try {
                $fs->save();
                $debug .= $fs->getId().' :: '.$fs->getFsName().'<br/>';
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        echo $debug;
    }
}
