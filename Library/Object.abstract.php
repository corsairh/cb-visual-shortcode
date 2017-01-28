<?php
/**
* 
*/

CBVSCodeFile::disallowDirectAccess();

/**
* 
*/
abstract class CBVSObject
{
    
    /**
    * put your comment there...
    * 
    * @var CBVSTempVariables
    */
    protected static $namedInstances = array();
    
    /**
    * put your comment there...
    * 
    * @param mixed $method
    * @param mixed $args
    * @return CBVSTempVariables
    */
    public static function __callStatic($instanceName, $args)
    {
        return self::$namedInstances[get_called_class()][$instanceName];
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $name
    * @param mixed $args
    */
    public static function & createNamedInstance($name, $args = null)
    {
        
        $className = get_called_class();
        
        if (isset(self::$namedInstances[$className][$name]))
        {
            throw new Exception("{$name} Named instance already exists");
        }
        
        // Create instance
        $class = new ReflectionClass($className);
        
        $instance = $class->newInstance($args);
        
        self::$namedInstances[$className][$name] =& $instance;
            
        return $instance;
    }
    
    /**
    * put your comment there...
    * 
    * @param mixed $object
    * @param mixed $type
    */
    public static function validateType($object, $type)
    {
        
        if (!is_object($object))
        {
            throw new Exception("Invalid object type, Expected {$type} " . gettype($object) . 'given');
        }
        
        $class = get_class($object);
        
        $parents  = class_parents($class);
        $parents += class_implements($class);
        $parents[] = $type;
        
        if (!in_array($class, $parents))
        {
            throw new Exception("Invalid object type, Expected {$type}, {$class} given");
        }
    }
}
