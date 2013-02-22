<?php
namespace Respect\Test\Reflection;

interface Reflectable
{
    function __construct($target);
    static function hasSupport($target);
    function setProperty($name, $value);
    function getProperty($name);
    function getInstance();
}
