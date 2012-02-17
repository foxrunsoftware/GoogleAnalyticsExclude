<?php

/**
 * This is the Google Analytics exclude button.
 * Note:  I just made up this path to contain this file because I thought it
 * seemed somewhat sensical.  This could have gone anywhere within the extension
 * Adminhtml/Block directory
 *
 * @author Justin Stern (www.foxrunsoftware.net)
 * @copyright  Copyright (c) 2012 Justin Stern
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class FoxRunSoftware_GoogleAnalyticsExclude_Adminhtml_Block_System_Config_Google_Ga_Exclude
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    /**
     * Generate synchronize button html
     *
     * @return string
     */
    protected function _getButtonHtml()
    {
    	
        $ga_exclude = Mage::getSingleton('core/cookie')->get(Mage::helper('googleanalytics/data')->getGoogleAnalyticsExcludeCookieName());
        
        if($ga_exclude) {
            $label = 'Include';
            $url = Mage::getSingleton('adminhtml/url')->getUrl('*/system_config_google_ga/include',
                                                               array('store' => $this->getRequest()->getParam('store'), 
                                                                     'website' => $this->getRequest()->getParam('website')));  // TODO:  not sure whether this is the correct way to grab the Current Configuration Scope
        } else {
            $label = 'Exclude';
            $url = Mage::getSingleton('adminhtml/url')->getUrl('*/system_config_google_ga/exclude',
                                                               array('store' => $this->getRequest()->getParam('store'),
                                                                     'website' => $this->getRequest()->getParam('website')));
        }
        
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'     => $this->__($label),
                'onclick'   => "window.location.href='{$url}'"
            ));

        return $button->toHtml();
    }

    /**
     * Seems a little odd to have to override this function, when the parameter
     * passed in is Varien_Data_Form_Element_Button, but that seems to create
     * a standard browser button, when what I want is the fancy Magento widget
     * button, and maybe there's no Varien_Data_Form_Element_Abstract for that
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        
        $this->setElement($element);
        
        return $this->_getButtonHtml();
    }
}
