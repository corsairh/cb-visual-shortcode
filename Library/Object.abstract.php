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
