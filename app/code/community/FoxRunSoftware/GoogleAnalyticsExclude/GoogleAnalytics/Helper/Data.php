<?php

/**
 * GoogleAnalytics data helper
 *
 * @author Justin Stern (www.foxrunsoftware.net)
 * @copyright  Copyright (c) 2012 Justin Stern
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * 
 * @category   FoxRunSoftware
 * @package    FoxRunSoftware_GoogleAnalyticsExclude
 */
class FoxRunSoftware_GoogleAnalyticsExclude_GoogleAnalytics_Helper_Data extends Mage_GoogleAnalytics_Helper_Data
{
	/**
	 * Google analytics exclude cookie name
	 * @var string
	 */
	const GA_EXCLUDE_COOKIE_NAME = 'ga_exclude';
	
    /**
     * Whether GA is ready to use
     *
     * @param mixed $store
     * @return bool
     */
    public function isGoogleAnalyticsAvailable($store = null)
    {
        return parent::isGoogleAnalyticsAvailable($store) && !Mage::getSingleton('core/cookie')->get(self::GA_EXCLUDE_COOKIE_NAME);
    }
	
	public function getGoogleAnalyticsExcludeCookieName() {
		return self::GA_EXCLUDE_COOKIE_NAME;
	}
}
