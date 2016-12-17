<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

/**
* 
*/
abstract class CBVSWPOptionsStatedObject
extends CBVSStatedObject
{
    
    /**
    * put your comment there...
    * 
    */
    protected function readStorage()
    {
        
        $data = get_option($this->__storageName, array());
        
        return $data;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $data
    * @return ASUStatedObject
    */
    protected function & writeStorage($data)
    {
        
        update_option($this->__storageName, $data);
        
        return $this;
    }
}