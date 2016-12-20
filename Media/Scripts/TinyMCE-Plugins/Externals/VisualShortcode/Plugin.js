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
            var makeVisualizesShortcodesClickable = function(event)
            {
                
                editor.$('.cb-visual-shortcode-wrapper').on('click',
                    
                    function()
                    {
                        model.showParametersForm(event);
                    }
                );
                
            };
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
                        
            // Switch from HTML to Visual View and load content
            // evey time Visualize function is requested
            editor.on('loadContent', makeVisualizesShortcodesClickable);
            
            // Make shortcode clickables after every visualization process
            CBPostMetaboxViewVisualShortcode.on('visualized', makeVisualizesShortcodesClickable);
        };

    }
);