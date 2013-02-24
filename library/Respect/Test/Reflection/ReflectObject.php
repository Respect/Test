<?php
namespace Respect\Test\Reflection;

use ReflectionObject, Closure;

class ReflectObject extends  AbstractReflectable
{

    protected function reflectionInstance($target)
    {
        return new ReflectionObject($target);
    }

    public function setProperty($name, $value)
    {
        $prop = $this->reflection->getProperty($name);
        $prop->setAccessible(true);
        if ($prop->isStatic())
            return $prop->setValue($value);
        return $prop->setValue($this->target, $value);
    }

    public function getProperty($name) {
        $prop = $this->reflection->getProperty($name);
        $prop->setAccessible(true);
        if ($prop->isStatic())
            return $prop->getValue();
        return $prop->getValue($this->target);
    }

    public static function hasSupport($target)
    {
        return is_object($target) && !($target instanceof Closure);
    }

    private function invoke($name, array $args = array())
    {
        $method = $this->reflection->getMethod($name);
        return $method->invokeArgs($this->target, $args);
    }

    function getInstance(array $args = array())
    {
        if (!empty($args))
            $this->invoke('__construct', $args);
        return $this->target;
    }
}
