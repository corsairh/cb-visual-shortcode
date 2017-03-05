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
                'config' => __DIR__ . DIRECTORY_SEPARATOR . 'Plugin.dev.php',
            ),
            
            CBVSPluginBase::ENV_STATE_PRO => array
            (
                'config' => __DIR__ . DIRECTORY_SEPARATOR . 'Plugin.inc.php',
            )
            
        )
    ),
    
    'uninstallable' => true,
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
            'VisualShortcodeMetabox' => 'Views/PostMetaboxVisualShortcode',
        )
        
    ),
    
    'resource' => array
    (
        'scriptsPath' => 'Media/Scripts',
        'stylesPath' => 'Media/Styles',
    ),
);
