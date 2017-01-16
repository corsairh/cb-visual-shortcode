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
    protected $storageName;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    protected $stateVars = array();
        
    /**
    * put your comment there...
    * 
    */
    protected function __construct() 
    {
        
        // Default storage name
        if (!$this->storageName)
        {
            $this->storageName = get_class($this);
        }
        
        // Read values
        $this->read();
        
        // INit object
        $this->_init();
        
    }
    
    /**
    * put your comment there...
    * 
    */
    protected function _init() {}
    
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
        
        foreach ($this->stateVars as $varname)
        {
            $storage[$varname] = $this->$varname;
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