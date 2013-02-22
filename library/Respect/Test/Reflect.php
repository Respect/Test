<?php
namespace Respect\Test;

use Respect\Test\Reflection\ReflectionFactory;

class Reflect
{
    private static $factory;
    private $reflection;

    private function __construct($target)
    {
        if (!isset(static::$factory))
            static::$factory = new ReflectionFactory();

        $this->reflection = static::$factory->produce($target);
    }

    public static function on($target)
    {
        return new static($target);
    }


    public function setProperty($name, $value) {
        $this->reflection->setProperty($name, $value);
        return $this;
    }

    public function getProperty($name) {
        return $this->reflection->getProperty($name);
    }

    public function getInstance() {
        return $this->reflection->getInstance();
    }
}
