<?php
/**
* 
*/

defined('ABSPATH') or die(-1);

/**
* 
*/
class CBVSPAddons
extends CBVSObject
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $addons;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $transient = 'cbvs_addons';
    
    /**
    * put your comment there...
    * 
    */
    public function __construct() {}
    
    /**
    * put your comment there...
    * 
    */
    public function addons()
    {
        
        // Try to get from transient, if not transient or expired
        // get from server
        $this->addons = get_transient($this->transient);        
        
        if (!$this->addons)
        {
            
            $plugin =& CBVSPlugin::me();
                    
            $config = $plugin->getConfigSection('plugin');

            $addonsConfig =& $config['store']['apiAddons'];
            $addonsUri = $addonsConfig['url'];

            $this->addons = array();
            
            $response = wp_remote_get($addonsUri);
            
            if (!($response instanceof WP_Error))
            {
                
                $feed = wp_remote_retrieve_body($response);
                $feedXML = new SimpleXMLElement($feed);

                $props = array('title', 'link', 'description');
                
                foreach ($feedXML->channel->item as $item)
                {
                    
                    $addon = array();
                    
                    foreach ($props as $name)
                    {
                        $addon[$name] = (string) $item->$name;
                    }
                    
                    $this->addons[] = $addon;
                }
                
                set_transient($this->transient, $this->addons, $addonsConfig['expires']);
            }
        }

        return $this->addons;
    }
    
}