/**
* 
*/

var CBPostMetaboxViewVisualShortcode;

/**
* 
*/
(function($)
{
    
    /**
    * 
    */
    CBPostMetaboxViewVisualShortcode = new function()
    {

        /**
        * put your comment there...
        * 
        */
        var locals;
        
        /**
        * put your comment there...
        * 
        * @type String
        */
        var metaboxElementId = 'cb-visual-shortcode';
        
        /**
        * put your comment there...
        * 
        * @type String
        */
        var visualizeButtonId = 'cb-visual-shortcode-button-visualize';
        
        /**
        * put your comment there...
        * 
        * @type String
        */
        var eventPrefix = metaboxElementId;

        /**
        * put your comment there...
        * 
        * @type T_JS_FUNCTION
        */
        var htmlEditor;
        
        /**
        * put your comment there...
        * 
        */
        var metaboxElement = null;
        
        /**
        * put your comment there...
        * 
        */
        var model = null;

        /**
        * put your comment there...
        * 
        */
        var shortcodeWrapperTag;
        
        /**
        * put your comment there...
        * 
        */
        var visualizeButtonElement;
        
        /**
        * put your comment there...
        * 
        */
        var visualizedTagsExpr;
        
        /**
        * put your comment there...
        * 
        * @param event
        */
        var _OnVisualizeButtonClick = function(event)
        {
            
            // Prompt if not in Visual View
            var isVisualView = $('#wp-content-wrap').hasClass('tmce-active');
            var editor;
            
            if (!isVisualView)
            {
                
                if (!confirm(locals.visualizeOnHTMLMode))
                {
                    return;
                }
            
                editor = htmlEditor;
            }
            else
            {
                editor = tinymce.get('content');
            }
            
            // Visualize
            var visualizedContent = visualizeShortcodes(editor.getContent());
            
            // Set editor text back
            editor.setContent(visualizedContent);
        };
        
        /**
        * put your comment there...
        * 
        * @param event
        */
        var getEventName = function(event)
        {
            
            var eventName = eventPrefix + '-' + event;
            
            return eventName;
        };
        
        /**
        * 
        */
        this.getModel = function()
        {
            return model;
        };
        
        /**
        * put your comment there...
        * 
        */
        this.metaboxElement = function()
        {
            return metaboxElement;
        };

        /**
        * put your comment there...
        * 
        */
        this.metaboxElementId = function()
        {
            return metaboxElementId;
        };

        /**
        * 
        */
        this.on = function(event, callback)
        {
            
            var eventName = getEventName(event);
            
            metaboxElement.on(eventName, callback);
            
            return this;
        };
        
        /**
        * 
        */
        this.setModel = function(value)
        {
            
            model = value;
            
            return this;
        };
        
        /**
        * 
        */
        this.trigger = function(event, args)
        {
            
            var eventName = getEventName(event);
            
            var result = metaboxElement.trigger(eventName, args);
            
            return result;
        };
        
        /**
        * put your comment there...
        * 
        * @param content
        */
        var visualizeShortcodes = function(content)
        {
            
            // Initialize
            var shortcodeTagExpr = wp.shortcode.regexp("([a-zA-Z0-9]+)");
            var visualizedShortcode;
            var visualizedShortcodes = [];
            var shortcode;
            var newWrappedShortcodes = [];
            var newWrappedShortcode;
            
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
            
            console.debug(content);
            
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
        
        // Initialization
        $($.proxy(
            
            function()
            {
                
                // Init elements
                visualizeButtonElement = $('#' + visualizeButtonId);
                metaboxElement = $('#' + metaboxElementId);
                
                // Get Shortcode wrapper code  and Expression, from template tag
                var visualizedShortcodeTemplate = $('#cb-visual-shortcode-shortcode-wrapper-template');
                
                shortcodeWrapperTag = $(visualizedShortcodeTemplate.get(0).content).find('>template').html().trim();
                visualizedTagsExpr = new RegExp(visualizedShortcodeTemplate.attr('data-expression'), 'gm');
                
                // Create HTML TextArea Interface similar to TinyMC Editor
                // INterface so accessin them using the same method names
                htmlEditor = new function()
                {
                    
                    /**
                    * put your comment there...
                    * 
                    */
                    var contentTextArea = $('textarea#content');
                    
                    /**
                    * 
                    */
                    this.getContent = function()
                    {
                        return contentTextArea.val();
                    };
                    
                    /**
                    * 
                    */
                    this.setContent = function(value)
                    {
                        contentTextArea.val(value);
                        
                        return this;
                    }
                };
                
                // Locals
                locals = CBPostMetaboxViewVisualShortcodeL10N;
                
                // Pre Init Event
                this.trigger('PreInit', [this]);
                 
                // Setting Visual Shortcode model object
                this.setModel(new CBVisualShortcode(this));
                
                this.trigger('GetModel', [this]);
                
                if (!model)
                {
                    throw "Model is not set!";
                }
                
                visualizeButtonElement.click($.proxy(_OnVisualizeButtonClick));
                
                // Init Event
                this.trigger('Init', [this]);
                
            }
        , this));
        
    };
    
})(jQuery);