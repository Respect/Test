<?php
namespace Respect\Test;

class StreamWrapperVerbose extends StreamWrapper
{
    public function __call($method, $arguments)
    {
        if (!isset(static::$wrapper))
            die('First set stream overrides.');
        $_arguments = array();
        foreach($arguments as $k => $v)
            $_arguments[$k] = var_export($v, true);
        echo '#  '.$method;
        echo '('.implode(', ', $_arguments).')'.PHP_EOL;
        debug_print_backtrace();
        echo "\n\n";
        return $this->delegate($method, $arguments);
    }
}
