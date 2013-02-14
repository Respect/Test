<?php
namespace Respect\Test;

use Respect\Test\StreamWrapper\StreamWrapperDelegate;
use Respect\Test\StreamWrapper\StreamEntity\FileStreamEntity;
use Exception, ReflectionObject;

class StreamWrapper
{
    protected static $wrapper,
                     $methods = array();

    public static function releaseOverrides()
    {
        static::$wrapper = null;
    }

    public static function setStreamOverrides(array $overrides)
    {
        static::releaseOverrides();
        $overrides = static::prepareOverrides($overrides);
        static::$wrapper = new StreamWrapperDelegate($overrides, get_called_class());
        static::interfacePrep();
        mkdir(getcwd());
    }

    private static function prepareOverrides(array $overrides)
    {
        $payload = array();
        foreach ($overrides as $path => $data) {
            $e = new FileStreamEntity();
            $e->setPath($path);
            if (is_resource($data)) {
                $e->setResource($data);
                $e->setOpen(true);
            }
            else {
                $e->setData($data);
                $e->openResource();
            }
            $payload[$e->getPath()] = $e;
        }
        return $payload;
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
            try {
                return static::$methods[$method]->invokeArgs(
                    static::$wrapper,
                    $arguments
                );
            } catch (Exception $e) {
                throw $e;
            }
        else
            throw new Exception("No method implemented for $method");
    }


    public function __call($method, $arguments)
    {
        if (!isset(static::$wrapper))
            throw new Exception('First inject stream overrides.');
        return $this->delegate($method, $arguments);
    }
}

