/**
* 
*/

tinymce.PluginManager.add("VisualShortcode",

    /**
    * 
    */
    function(editor, url)
    {
        
        /**
        * put your comment there...
        * 
        */
        var $ = jQuery;
        
        /**
        * put your comment there...
        * 
        */
        var model;
        
        /**
        * put your comment there...
        * 
        * @type T_JS_FUNCTION
        */
        var CBVisualShortcodePlugin = new function()
        {
        
            /**
            * put your comment there...
            * 
            */
            var initVisualShortcodePlugin = function()
            {
                
                // Get Visual Shortcode Model object instance
                model = CBPostMetaboxViewVisualShortcode.getModel();
                
                
            };
            
            // Edit init
            editor.on('init', initVisualShortcodePlugin);
        
            // Switch from HTML to Visual View
            //editor.on('loadContent', initVisualShortcode);
        };

    }
);