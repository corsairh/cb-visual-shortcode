<?php
/**
* 
*/

CBVSCodeFile::disallowDirectAccess();

/**
* 
*/
return array
(
    'env' => array
    (
    
        'state' => CBVSPluginBase::ENV_STATE_DEV,
         
        'states' => array
        (
            CBVSPluginBase::ENV_STATE_DEV => array
            (
                'extension' => 'dev'
            ),
            
            CBVSPluginBase::ENV_STATE_PRO => array
            (
                'extension' => 'inc'
            )
            
        )
    )
);
