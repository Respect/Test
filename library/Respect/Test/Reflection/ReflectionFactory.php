<?php
namespace Respect\Test\Reflection;

use DirectoryIterator;

class ReflectionFactory
{
    private static $reflectables = array();

    public function produce($target)
    {
        foreach ($this->reflectables() as $reflectable)
            if ($reflectable::hasSupport($target))
                return new $reflectable($target);
    }

    private function reflectables()
    {
        if (empty(static::$reflectables))
            foreach (scandir(__DIR__) as $f)
                if ($f != $file = preg_replace('/\.php$/', '', $f))
                    if (class_exists($class = __NAMESPACE__.'\\'.$file))
                        if (array_key_exists(
                            __NAMESPACE__.'\\AbstractReflectable',
                            class_parents($class)))
                            static::$reflectables[] = $class;
        return static::$reflectables;
    }
}
