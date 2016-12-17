<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

/**
* 
*/
class CBVSPlugin extends CBVSPluginBase
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private static $hooks;
    
    /**
    * 
    */
    public static function & hooks()
    {
        return self::$hooks;
    }
    
    /**
    * put your comment there...
    * 
    */
    protected function init()
    {
        
        parent::init();
        
        // Hooks instance
        self::$hooks =& CBVSPluggable::getInstance();
                    
        // Install
        if (CBVSInstaller::create()->isInstalled() != CBVSInstaller::INSTALLED)
        {
            try
            {
                CBVSInstaller::getInstance()->install();
            }
            catch (Exception $exception)
            {
                
                echo self::__('Couldnt instal Visual Shortcode Plugin. Details:', $exception->getMessage());
                
                return;
            }
        }
        
        // Services
        if (is_admin())
        {
            // Post metabox
            CBVSServiceDashboardPostMetabox::run();
        }
        
    }
    
}