<?php
namespace Respect\Test;

use Respect\Test\StreamWrapper\StreamWrapperDelegate;
use Respect\Test\StreamWrapper\StreamEntity\FileStreamEntity;
use Exception, InvalidArgumentException, ReflectionObject;

class StreamWrapper
{
    protected static $wrapper = null,
                     $methods = array();

    public static function releaseOverrides()
    {
        static::$wrapper = null;
    }

    public static function setStreamOverrides(array $overrides)
    {
        static::releaseOverrides();
        static::$wrapper = new StreamWrapperDelegate($overrides, get_called_class());
        static::interfacePrep();
        mkdir(getcwd());
    }

    private static function interfacePrep()
    {
        if (empty(static::$methods)) {
            $interface       = new ReflectionObject(static::$wrapper);
            $methods         = $interface->getMethods();
            static::$methods = array_combine(array_map(function ($v) {
                return $v->getName();
            }, $methods), $methods);
        }
    }

    protected function delegate($method, $arguments)
    {
        if (array_key_exists($method, static::$methods))
            if(($required = static::$methods[$method]->getNumberOfRequiredParameters())
                != ($count = count($arguments)))
                throw new InvalidArgumentException("Invalid number of required arguments for method " .
                    "$method, expected $required but found $count.");
            else
                return static::$methods[$method]->invokeArgs(
                    static::$wrapper,
                    $arguments
                );
        else
            throw new Exception("No method implemented for $method");
    }


    public function __call($method, $arguments)
    {
        if (is_null(static::$wrapper))
            throw new Exception('First inject stream overrides.');
        return $this->delegate($method, $arguments);
    }
}

