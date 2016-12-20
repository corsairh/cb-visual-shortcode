<?php
/**
* 
*/

/**
* 
*/
return array
(

    'config' => array
    (
    
        'local' => array
        (
            'textDomain' => 'cb-visual-shortcode',
            'dir' => 'Languages',
        ),
        
        'slugNamespace' => 'cbvs',
        
    ),
    
    'installer' => 'CBVSInstaller',
    
    'view' => array
    (
    
        'extension' => 'html.php',
        
        'views' => array
        (
            'VisualShortcodeMetabox' => 'Views/PostMetaboxVisualShortcode'
        )
        
    ),
    
    'resource' => array
    (
        'scriptsPath' => 'Media/Scripts',
        'stylesPath' => 'Media/Styles',
    ),

);