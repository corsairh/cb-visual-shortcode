<?php
/**
* 
*/

CBVSCodeFile::disallowDirectAccess();

/**
* 
*/
class CBVSStatedObjectStorageWPOption
extends CBVSStatedObjectStorage
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    protected $userId;
    
    /**
    * put your comment there...
    * 
    */
    protected function _init()
    {
        // Get User ID
        $suppliedUserID = (int) $this->getOpt('userId');
        
        $this->userId = $suppliedUserID ? $suppliedUserID : get_current_user_id();
    }
    
    /**
    * put your comment there...
    * 
    */
    public function read()
    {
        
        $data = get_user_meta($this->userId, $this->name, array());
        
        return $data;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $data
    */
    public function & write($data)
    {
        update_user_meta($this->userId, $this->name, $data);
        
        return $this;
    }
}