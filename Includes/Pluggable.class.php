<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

/**
* 
*/
class CBVSPluggable extends CBVSPluggableInterface
{
    
    const ACTION_VISUALIZE_POST_METABOX_ENQUEUE_MODEL = 'visualize-post-metabox-enqueue-model';
    const ACTION_VISUALIZE_POST_METABOX_ENQUEUE_SCRIPTS = 'visualize-post-metabox-enqueue-scripts';
    const ACTION_VISUALIZE_POST_METABOX_ENQUEUE_STYLES = 'visualize-post-metabox-enqueue-styles';
    
    const FILTER_VISUALIZE_POST_METABOX_PARAMETERS = 'visualize-post-metabox-parameters';
    const FILTER_VISUALIZE_POST_METABOX_VIEW = 'visualize-post-metabox-view';
    const FILTER_VISUALIZE_POST_METABOX_VIEW_TEMPLATE = 'visualize-post-metabox-view-template';
    const FILTER_VISUALIZE_POST_METABOX_SHORTCODE_WRAPPER_TEMPLATE = 'visualize-post-metabox-shortcode-wrapper-template';
    
    const FILTER_VISUALIZE_TINYMCE_STYLES = 'visualize-tinymce-styles';
    const FILTER_VISUALIZE_TINYMCE_EXTERNAL_PLUGINS = 'visualize-tinymce-external-plugins';
    
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setTinyMCEExternalPlugins($callback)
    {        
        return $this->addFilter(
            self::FILTER_VISUALIZE_TINYMCE_EXTERNAL_PLUGINS, 
            $callback
        );
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setTinyMCEStyles($callback)
    {        
        return $this->addFilter(
            self::FILTER_VISUALIZE_TINYMCE_STYLES, 
            $callback
        );
    }
        
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setVisualizeMetaboxModel($callback)
    {        
        return $this->addFilter(
            self::ACTION_VISUALIZE_POST_METABOX_ENQUEUE_MODEL, 
            $callback
        );
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setVisualizeMetaboxParameters($callback)
    {        
        return $this->addFilter(
            self::FILTER_VISUALIZE_POST_METABOX_PARAMETERS,
            $callback
        );
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setVisualizeMetaboxView($callback)
    {        
        return $this->addFilter(
            self::FILTER_VISUALIZE_POST_METABOX_VIEW,
            $callback
        );
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $callback
    */
    public function setVisualizeMetaboxViewTemplate($callback)
    {        
        return $this->addFilter(
            self::FILTER_VISUALIZE_POST_METABOX_VIEW_TEMPLATE,
            $callback
        );
    }
    
    /**
    * put your comment there...
    * 
    */
    public function getVisualizeMetaboxParameters($parameters)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_POST_METABOX_PARAMETERS,
            $parameters
        );
    }

    /**
    * put your comment there...
    * 
    * @param mixed $plugins
    */
    public function tinyMCEExternalPlugins($plugins)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_TINYMCE_EXTERNAL_PLUGINS,
            $plugins
        ); 
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $styles
    */
    public function tinyMCEStyles($styles)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_TINYMCE_STYLES,
            $styles
        ); 
    }
    
    /**
    * put your comment there...
    * 
    */
    public function visualizeMetaboxEnqueueModel()
    {
        return $this->doAction(
            self::ACTION_VISUALIZE_POST_METABOX_ENQUEUE_MODEL
        );
    }
    
    /**
    * put your comment there...
    * 
    */
    public function visualizeMetaboxEnqueueScripts()
    {
        return $this->doAction(
            self::ACTION_VISUALIZE_POST_METABOX_ENQUEUE_SCRIPTS
        );
    }
    
    /**
    * put your comment there...
    * 
    */
    public function visualizeMetaboxEnqueueStyles()
    {
        return $this->doAction(
            self::ACTION_VISUALIZE_POST_METABOX_ENQUEUE_STYLES
        );
    }

    /**
    * put your comment there...
    * 
    * @param mixed $view
    */
    public function visualizeMetaboxView($view)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_POST_METABOX_VIEW,
            $view
        );
    }

    /**
    * put your comment there...
    * 
    * @param mixed $content
    */
    public function visualizeMetaboxViewTemplate($content)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_POST_METABOX_VIEW_TEMPLATE,
            $content
        );
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $content
    */
    public function visualizeShortcodeWrapperTemplate($content)
    {
        return $this->applyFilter(
            self::FILTER_VISUALIZE_POST_METABOX_SHORTCODE_WRAPPER_TEMPLATE,
            $content
        );
    }
}