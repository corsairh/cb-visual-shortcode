<?php
/**
* 
*/

// No direct access
defined('ABSPATH') or die();

/**
* 
*/
abstract class CBVSPluginBase
{
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $config;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $dir;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $file;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $textDomain;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $url;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $urlScripts;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $urlStyles;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private static $instances;
    
    /**
    * put your comment there...
    * 
    * @param mixed $text
    */
    public static function __($text)
    {
        
        $instance =& self::getPlugin(get_called_class());
        
        $localText = __($text, $instance->textDomain);
        
        // Placehoders
        $args = func_get_args();
        
        if (!empty($args))
        {
            
            $args[0] = $localText;
            
            $localText = call_user_func_array('sprintf', $args);
        }
        
        return $localText;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $file
    * @param mixed $config
    * @return CBVSPlugin
    */
    protected function __construct($file, $config) 
    {
        
        // INit
        $this->file = $file;
        $this->dir = dirname($file);
        $this->url = plugin_dir_url($this->getFile());
        
        // Config
        $this->config = $config;
        
        // Resources Urls
        $this->urlScripts = "{$this->url}/{$config['resource']['scriptsPath']}";
        $this->urlStyles = "{$this->url}/{$config['resource']['stylesPath']}";
        
    }

    /**
    * put your comment there...
    * 
    * @param mixed $text
    */
    public static function _e($text)
    {
        
        $callerClass = get_called_class();
        
        $args[] = func_get_args();
        array_unshift($args, $text);
        
        $localTxt = call_user_func_array(array($callerClass, '__'), func_get_args());
        
        echo $localTxt;
    }
    
    /**
    * put your comment there...
    * 
    */
    public function _localize()
    {
        
        $localDir = $this->config['localization']['dir'];
        
        load_plugin_textdomain(
            $this->textDomain, 
            false, 
            basename(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $localDir
        );
    }

    /**
    * put your comment there...
    * 
    */
    public function getConfig()
    {
        return $this->config;
    }
    
    /**
    * put your comment there...
    * 
    */
    public function getDir()
    {
        return $this->dir;
    }
        
    /**
    * put your comment there...
    * 
    */
    public function getFile()
    {
        return $this->file;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $class
    */
    public static function & getPlugin($class)
    {
        
        if (!isset(self::$instances[$class]))
        {
            throw new Exception("{$class} Plugin does nto exists!!");
        }
        
        $instance =& self::$instances[$class];
        
        return $instance;
    }
    
    /**
    * 
    */
    public static function & hooks()
    {
        return self::$hooks;
    }
    
    /**
    * put your comment there...
    * 
    */
    protected function init()
    {
        // Localize
        add_action('plugins_loaded', array($this, '_localize'));
    }
    
    /**
    * put your comment there...
    * 
    * @return CBVSPluginBase
    */
    public static function & me()
    {
        
        $instance = self::getPlugin(get_called_class());
        
        return $instance;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $file
    * @param mixed $config
    */
    public static function & plug($file, $config)
    {
        
        $pluginClass = get_called_class();
        
        if (!self::$instances[$pluginClass])
        {
            
            // Instantiate
            $instance = new $pluginClass($file, $config);
            $instance->init();
            
            // Cache it!
            self::$instances[$pluginClass] = $instance;
        }
        
        return self::$instances[$pluginClass];
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $name
    * @param mixed $vars
    */
    public function renderView($name, $vars = array())
    {
        
        // Get view path
        $config =& $this->config;
        $tmpExtension = $config['view']['extension'];
        
        if (!isset($config['view']['views'][$name]))
        {
            throw new Exception("{$name} Template could not be loaded!!!");
        }
        
        $tmpPath = str_replace(
            '/', 
            DIRECTORY_SEPARATOR, 
            $config['view']['views'][$name]
        );
                              
        # Extract template vars to be simply accessible by template
        extract($vars);
        
        # Reneder template
        ob_start();
        
        require $this->getDir() . DIRECTORY_SEPARATOR . "{$tmpPath}.{$tmpExtension}";
    
        $template = ob_get_clean();
        
        return $template;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $path
    */
    public function url($path)
    {
        
        $url = "{$this->url}{$path}";
        
        return $url;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $style
    */
    public function urlScript($scriptPath)
    {
        
        $url = "{$this->urlScripts}/{$scriptPath}";
        
        return $url;
    }
        
    /**
    * put your comment there...
    * 
    * @param mixed $style
    */
    public function urlStyle($stylePath)
    {
        
        $url = "{$this->urlStyles}/{$stylePath}";
        
        return $url;
    }
}