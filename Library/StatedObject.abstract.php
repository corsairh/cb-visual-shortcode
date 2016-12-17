<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

/**
* 
*/
abstract class CBVSStatedObject
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    protected $__storageName;
        
    /**
    * put your comment there...
    * 
    */
    public function __construct() 
    {
        
        // Default storage name
        if (!$this->__storageName)
        {
            $this->__storageName = get_class($this);
        }
        
        // Read values
        $this->read();
        
        // INit object
        $this->init();
    }
    
    /**
    * put your comment there...
    * 
    */
    protected function init() {}
    
    /**
    * put your comment there...
    * 
    */
    protected function & read()
    {
        
        $storageVars = $this->readStorage();
        
        foreach ($storageVars as $varName => $value)
        {
            $this->$varName = $value;
        }
        
        return $this;
    }
    
    /**
    * put your comment there...
    * 
    */
    protected abstract function readStorage();
    
    /**
    * put your comment there...
    * 
    */
    public function & write()
    {
        
        $storage = array();
        
        $vars = get_object_vars($this);
        
        foreach ($vars as $varName => $value)
        {
            
            if (strpos($varName, '__') !== 0)
            {
                $storage[$varName] = $value;
            }
            
        }
        
        $this->writeStorage($storage);
        
        return $this;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $data
    */
    protected abstract function writeStorage($data);
    
}