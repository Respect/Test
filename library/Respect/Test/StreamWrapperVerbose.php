<?php
namespace Respect\Test;

class StreamWrapperVerbose extends StreamWrapper
{
    public static $verboseMethod;

    public function __call($method, $arguments)
    {
        if (is_null(static::$wrapper))
            throw new Exception('First inject stream overrides.');

        echo "# $method(";
        $args = array();
        foreach($arguments as $v)
            $args[] = var_export($v, true);
        echo implode(', ', $args), ")\n";
        if ($method == static::$verboseMethod)
            debug_print_backtrace();
        return $this->delegate($method, $arguments);
    }
}
