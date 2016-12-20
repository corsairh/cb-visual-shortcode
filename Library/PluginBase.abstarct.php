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
    private $modules = array();
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $name;
    
    /**
    * put your comment there...
    * 
    * @var mixed
    */
    private $services = array();
    
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
    public function __($text)
    {
        
        // Call $this->getText() with all passed args + text domain as first parameter
        $args = func_get_args();
        
        array_unshift($args, $this->textDomain);
        
        $localText = call_user_func_array(
            array($this, 'getText'),
            $args
        );
        
        return $localText;
    }

    /**
    * put your comment there...
    * 
    * @param mixed $file
    * @param mixed $config
    * @return CBVSPlugin
    */
    protected function __construct($file, $config = array()) 
    {
        
        // INit
        $this->file = $file;
        $this->name = basename($file);
        $this->dir = dirname($file);
        $this->url = plugin_dir_url($this->getFile());
        
        // Config
        $this->config = $config;
        
        $this->textDomain = $this->config['config']['local']['textDomain'];
        
    }

    /**
    * put your comment there...
    * 
    * @param mixed $text
    */
    public function _e($text)
    {
        
        $localTxt = call_user_func_array(array($this, '__'), func_get_args());
        
        echo $localTxt;
    }
    
    /**
    * put your comment there...
    * 
    */
    public function _localize()
    {
        
        // Localize plugin/module
        $localConfig =& $this->config['config']['local'];

        load_plugin_textdomain(
            $this->textDomain, 
            false, 
            $this->name . DIRECTORY_SEPARATOR . $localConfig['dir']
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
    * @param mixed $name
    */
    public function & getModule($name)
    {
        
        if (!isset($this->modules[$name]))
        {
            throw new Exception("{$name} module doesnt exists!");
        }
        
        return $this->modules[$name];
    }
    
    /**
    * put your comment there...
    * 
    */
    public function getModules()
    {
        return $this->modules;
    }
    
    /**
    * put your comment there...
    * 
    */
    public function getName()
    {
        return $this->name;
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
    * put your comment there...
    * 
    */
    public function getSlugNamespace()
    {
        
        $slugNs = $this->config['config']['slugNamespace'];
        
        return $slugNs;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $text
    * @param mixed $domain
    */
    public function getText($domain, $text)
    {
        
        $localText = __($text, $domain);
        
        // Placholder as all args after excluding domain and text args
        $args = array_slice(func_get_args(), 2);
        
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
    */
    public function getTextDomain()
    {
        return $this->textDomain;
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
    protected function & loadModules()
    {
        
        // Init
        $modulesConfig =& $this->config['modules'];
        $modulesDir = $this->getDir() . DIRECTORY_SEPARATOR . $modulesConfig['dir'];
        
        // Load all modules
        $modulesNamespace = $modulesConfig['namespace'];
        
        foreach ($modulesConfig['list'] as $moduleName => $moduleData)
        {
            
            // Build module file path
            $moduleFileRelPath =    $moduleData['dirName'] .
                                    DIRECTORY_SEPARATOR . "Plugin-Module-{$moduleData['dirName']}.class.php";
                                    
            $moduleFileAbsPath =    $modulesDir . DIRECTORY_SEPARATOR . $moduleFileRelPath;
            
            // Module config file
            $moduleConfigFilePath = $modulesDir . DIRECTORY_SEPARATOR . 
                                    $moduleData['dirName'] . DIRECTORY_SEPARATOR .
                                    'Config.inc.php';
                                    
            $moduleConfig = file_exists($moduleConfigFilePath) ? 
                            require $moduleConfigFilePath :
                            array();

            // Merge only config section from parent plugin/module
            $moduleConfig['config'] = array_merge(
                $this->config['config'], 
                $moduleConfig['config']
            );
                                        
            // get Module class
            $moduleClass = "{$modulesNamespace}{$moduleName}";

            // Load module
            $module = call_user_func(
                array($moduleClass, 'Plug'),
                $moduleFileAbsPath,
                $moduleConfig
            );
            
            // Bind module
            $module->bind($this);
            
            // Hold module pointer
            $this->modules[$moduleName] = $module;
            
        }
        
        return $this;
    }

    /**
    * put your comment there...
    * 
    */
    public function & loadServices()
    {
        
        $servicesClass = func_get_args();
        
        foreach ($servicesClass as $serviceClass)
        {
            
            $serviceObject = new $serviceClass($this);

            $this->services[$serviceClass] = $serviceObject;            
        }
        
        return $this;
    }
    
    /**
    * put your comment there...
    * 
    * @return BOOL|Exception True if installed successed or Exception if installation faild
    */
    protected function init() 
    {
        
        // Out if not installer defined
        if (!isset($this->config['installer']) || 
            !$this->config['installer'])
        {
            return true;
        }
        
        // Get installer instance
        $installerClass = $this->config['installer'];
        $installer = call_user_func(array($installerClass, 'create'));
        
        // Install
        if ($installer->isInstalled() != CBVSInstallerBase::INSTALLED)
        {
            try
            {
                // Install
                $installer->install();
            }
            catch (Exception $exception)
            {
                return $exception;
            }
        }
        
        return true;
        
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
        
        if (!isset(self::$instances[$pluginClass]))
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
        
        $templateFilePath = $this->getDir() . DIRECTORY_SEPARATOR . "{$tmpPath}.{$tmpExtension}";
        
        if (!file_exists($templateFilePath))
        {
            throw new Exception("{$name} Template file doesnt exists!");
        }
        
        # Extract template vars to be simply accessible by template
        extract($vars);
        
        # Reneder template
        ob_start();
        
        require $templateFilePath;
    
        $template = ob_get_clean();
        
        return $template;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $path
    */
    public function url($path = '')
    {
        
        if ($path)
        {
            $path .= "/{$path}";
        }
        
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
 
    /**
    * put your comment there...
    * 
    */
    protected function & useLocalization()
    {
        
        add_action('plugins_loaded', array($this, '_localize'));
        
        return $this;
    }
    
    /**
    * put your comment there...
    * 
    */
    protected function & useResources()
    {
        
        // Resources Urls
        $this->urlScripts = "{$this->url}/{$this->config['resource']['scriptsPath']}";
        $this->urlStyles = "{$this->url}/{$this->config['resource']['stylesPath']}";
        
        return $this;
    }
    
}