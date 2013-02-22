<?php
namespace Respect\Test\Reflection;

use ReflectionClass;

class ReflectClass extends  ReflectObject
{
    protected function reflectionInstance($target)
    {
        return new ReflectionClass($target);
    }

    public function __get($name)
    {
        if ($name == 'target' && is_string($this->_target))
            $this->_target = $this->newInstance($this->reflection);
        return parent::__get($name);
    }

    private function newInstance(ReflectionClass $reflector)
    {
        if ($reflector->isInstantiable()
            && (is_null($constructor = $reflector->getConstructor())
                || $constructor->getNumberOfRequiredParameters() == 0))
            return $reflector->newInstance();

        if (method_exists($reflector, 'newInstanceWithoutConstructor'))
            return $reflector->newInstanceWithoutConstructor();

        $props = $reflector->getProperties();
        $defaults = $reflector->getDefaultProperties();
        $class = $reflector->getName();

        $serealized = "O:" . strlen($class) . ":\"$class\":".count($props) .':{';
        foreach ($props as $property){
            $name = $property->getName();
            if($property->isProtected())
                $name = chr(0) . '*' .chr(0) .$name;
            elseif($property->isPrivate())
                $name = chr(0)  . $class.  chr(0).$name;
            $serealized .= serialize($name);
            if(array_key_exists($property->getName(), $defaults) )
                $serealized .= serialize($defaults[$property->getName()]);
            else
                $serealized .= serialize(null);
        }
        $serealized .="}";
        return unserialize($serealized);
    }

    public static function hasSupport($target)
    {
        return is_string($target) && class_exists($target);
    }
}
