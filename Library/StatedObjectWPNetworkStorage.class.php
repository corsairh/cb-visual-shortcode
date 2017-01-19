<?php
/**
* 
*/

CBVSCodeFile::disallowDirectAccess();

/**
* 
*/
class CBVSStatedObjectStorageWPNetwork
extends CBVSStatedObjectStorage
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    protected $networkId;
    
    /**
    * put your comment there...
    * 
    */
    protected function _init()
    {
        
        $suppliedNetworkId = (int) $this->getOpt('networkId');
        
        $this->networkId =  $suppliedNetworkId ?
                            $suppliedNetworkId :
                            get_main_network_id();
                            
    }
    
    /**
    * put your comment there...
    * 
    */
    public function read()
    {
        $data = get_network_option($this->networkId, $this->name, array());
        
        return $data;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $data
    */
    public function & write($data)
    {
        update_network_option($this->networkId, $this->name, $data);
        
        return $this;
    }
}