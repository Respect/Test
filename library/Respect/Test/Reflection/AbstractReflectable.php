<?php
namespace Respect\Test\Reflection;

abstract class AbstractReflectable implements Reflectable
{
    protected $reflection, $_target;

    abstract protected function reflectionInstance($target);

    function __construct($target)
    {
        $this->_target = $target;
        $this->reflection = $this->reflectionInstance($target);
    }

    public function __get($name)
    {
        return $this->{"_$name"};
    }

    public function __set($name, $value)
    {
        $this->{"_$name"} = $value;
    }
}
