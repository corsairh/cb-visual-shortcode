<?php
/**
* Plugin Name: CB Visual Shortcode
* Description: Turns textual Wordpress Post Shortcodes into Visual Shortcode, allow users to change shortcode attributes with using simple web form
* Version: 0.5.0
* Author: AHMeD SAiD
* Author URI: http://github.com/xpointer
* Plugin URI: http://ec2-54-200-243-228.us-west-2.compute.amazonaws.com/cb-vs
* Text Domain: cb-visual-shortcode
* License: GPL2
*/

// No direct access
defined('ABSPATH') or die();

# Autoload
require __DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php';

// Plug
CBVSPlugin::plug(

    __FILE__,
    
    CBVSPlugin::envLoadConfig(
    
        /* Env Config */
        require __DIR__ . DIRECTORY_SEPARATOR .
                'Config' . DIRECTORY_SEPARATOR . 'Config.php',
        
        /* Config */
        __DIR__ . DIRECTORY_SEPARATOR .
        'Config' . DIRECTORY_SEPARATOR . 'Plugin.%ext%.php'    
    )
);