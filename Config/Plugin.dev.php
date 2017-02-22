<?php
/**
* 
*/

/**
* 
*/
return array
(

    'uninstallable' => true,
    'config' => array
    (
    
        'local' => array
        (
            'textDomain' => 'cb-visual-shortcode',
            'dir' => 'Languages',
        ),
        
        'slugNamespace' => 'cbvs',
        
        'visualShortcode' => array
        (
            'store' => array
            (
                'apiEndPoint' => 'http://visualshortcode.lan/cbstore',
                'apiAddons' => array
                (
                    'url' => 'http://visualshortcode.lan/plugins/visual-shortcode-community-edition/feed/?items=addons',
                    'expires' => 0,
                ),
            )
        )
    ),
    
    'installer' => 'CBVSInstaller',
    
    'view' => array
    (
    
        'extension' => 'html.php',
        
        'views' => array
        (
            'VisualShortcodeMetabox' => 'Views/PostMetaboxVisualShortcode',
        )
        
    ),
    
    'resource' => array
    (
        'scriptsPath' => 'Media/Scripts',
        'stylesPath' => 'Media/Styles',
    ),

);