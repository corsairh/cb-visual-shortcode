/**
* 
*/

var CBVisualShortcode;

/**
* 
*/
(function($)
{

    /**
    * put your comment there...
    * 
    * @param controller
    * @param options
    */
    CBVisualShortcode = function(controller, options)
    {
        
        // Default options
        var opts = $.extend(
            {
                
            },
            options
        );
        
        /**
        * 
        */
        this.getOptions = function()
        {
            return opts;
        };
        
        
        /**
        * put your comment there...
        * 
        * @param content
        */
        this.visualizeShortcodes = function(content)
        {
            
            // Initialize
            var visualizedShortcodes = [];
            var newWrappedShortcodes = [];
            var visualizedShortcode;
            var shortcode;
            var newWrappedShortcode;
            
            var visualizedTagsExpr = controller.getVisualizedTagsExpression();
            var shortcodeTagExpr = controller.getShortcodeTagsExpression();
            
            /**
            * Check whether the current shortocde is already
            * wrapper with visual shortcode tags VST
            * 
            * @returns {Boolean}
            */
            var isVisualized = function()
            {
                
                var visualizedShortcode;
                var index = 0;
                
                for (; index < visualizedShortcodes.length ; index++)
                {
                    
                    visualizedShortcode = visualizedShortcode = visualizedShortcodes[index];
                    
                    // disacrd visualized shortcode
                    if ((shortcode.index > visualizedShortcode.startOffset) && 
                        (shortcode.index < visualizedShortcode.endOffset))
                    {
                        
                        return true;
                    }                    
                }
                
                return false;
            };
            
            // Get all Already visualized Shortcodes to avoid 
            // visualizing (wrap with visual shortcode plugin HTML tags!) it twice
            while (visualizedShortcode = visualizedTagsExpr.exec(content))
            {

                visualizedShortcodes.push(
                    {
                        startOffset : visualizedShortcode.index,
                        endOffset : (visualizedShortcode.index + visualizedShortcode[0].length)
                    }
                );
            }
            
            var shortcodeWrapperTag = controller.getShortcodeWrapperTag();
            
            // Find all Shortcodes, don't process those already visualized
            while (shortcode = shortcodeTagExpr.exec(content))
            {
            
                if (!isVisualized(shortcode))
                {
                    
                    // Wrap snapped shortcode
                    newWrappedShortcodes.push(
                        {
                            shortcode : shortcode,
                            wrapperShortcodeHTML : shortcodeWrapperTag
                                                    .replace('%shortcode_name%', shortcode[2])
                                                    .replace('%shortcode%', shortcode[0])
                        }
                    );
                    
                }

            }
            
            // Avoid index changing issue by reversing elements
            newWrappedShortcodes = newWrappedShortcodes.reverse();
            
            for (var index in newWrappedShortcodes)
            {
                
                newWrappedShortcode = newWrappedShortcodes[index];
                
                // Replace in conent
                content =   content.substring(0, newWrappedShortcode.shortcode.index) + 
                
                            newWrappedShortcode.wrapperShortcodeHTML + 
                            
                            content.substring(( newWrappedShortcode.shortcode.index + 
                                                newWrappedShortcode.shortcode[0].length)
                                                );

            }

            return content;
            
        };
        
    };
    
})(jQuery);