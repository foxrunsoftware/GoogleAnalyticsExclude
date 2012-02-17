<?php

/**
 * Adminhtml account controller
 *
 * @author Justin Stern (www.foxrunsoftware.net)
 * @copyright  Copyright (c) 2012 Justin Stern
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * 
 * @category    Mage
 * @package     Mage_Adminhtml
 */
class FoxRunSoftware_GoogleAnalyticsExclude_Adminhtml_System_Config_Google_GaController 
  extends Mage_Adminhtml_Controller_Action
{
    /**
     * Set the ga_exclude cookie, to exclude this browser from Google Analytics
     * 
     * @return void
     */
    public function excludeAction()
    {	
        // set or renew the cookie
        // TODO:  this assumes the host of the admin matches that of the store.  What
        //  would we do for a Magento with multiple stores, and for the different
        //  configuration scopes?
        Mage::getSingleton('core/cookie')->set(Mage::helper('googleanalytics/data')->getGoogleAnalyticsExcludeCookieName(),1,3600 * 24 * 365 * 5,'/',null,false);
        
        $this->_saveState();
        
        $this->_redirectToGoogleConfig();
    }
    
    /**
     * Remove the ga_exclude cookie, to include this browser in Google Analytics
     * 
     * @return void
     */
    public function includeAction()
    {
        // delete the cookie
        Mage::getSingleton('core/cookie')->delete(Mage::helper('googleanalytics/data')->getGoogleAnalyticsExcludeCookieName());
        
        $this->_saveState();
        
        $this->_redirectToGoogleConfig();
    }
    
    /**
     * Redirect back to the admin system configuration Google edit screen
     */
    protected function _redirectToGoogleConfig() {
        // TODO: not sure whether this is the proper way grab the current configuration scope
        $this->_redirect('*/system_config/edit', array('section' => 'google', 
                                                       'store' => $this->getRequest()->getParam('store'), 
                                                       'website' => $this->getRequest()->getParam('website')));
    }
    
    /**
     * Mark the Google Analytics fieldset as not-collapsed
     */
    protected function _saveState() {
        $adminUser = Mage::getSingleton('admin/session')->getUser();
        $extra = $adminUser->getExtra();
        
        if (!is_array($extra)) {
            $extra = array();
        }
        if (!isset($extra['configState'])) {
            $extra['configState'] = array();
        }
        $extra['configState']['google_analytics'] = 1;  // TODO: not sure whether there is a 'proper' place to grab the string 'google_analytics' from
        
        $adminUser->saveExtra($extra);
    }
}
