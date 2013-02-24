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
            $this->_target = $this->newInstance();
        return parent::__get($name);
    }

    private function newInstance()
    {
        $reflector = $this->reflection;
        if ($reflector->isInstantiable()
            && (is_null($constructor = $reflector->getConstructor())
                || $constructor->getNumberOfRequiredParameters() == 0))
            return $reflector->newInstance();

        if ($reflector->isAbstract()) {
            $name = $reflector->getShortName();
            $ns = false;
            $abstract = $reflector->inNamespace()
                ? 'namespace '. ($ns = $reflector->getNamespaceName()) .'; '
                : '';
            if (!class_exists($mockAbstract = (empty($ns) ? '' : $ns.'\\')."Mock$name")) {
                $abstract .= "class Mock$name extends $name { ";
                foreach (array_filter(
                    $reflector->getMethods(),
                    function ($v) use ($reflector) {
                        return $v->isAbstract();
                    }
                 ) as $func)
                    $abstract .= ($func->isStatic() ? ' static' : '')
                    . ' public function '
                    . $func->getName() . '('. implode(', ', array_map(
                        function ($par) {
                            return ($par->isArray() ? 'array ' : '')
                                . ($par->isPassedByReference()? '&' : '')
                                . '$'.$par->getName()
                                . ($par->isDefaultValueAvailable()
                                    ? '=' . var_export($par->getDefaultValue(), true)
                                    : '');
                        },
                        $func->getParameters()
                    )) . ') {}';
                $abstract .= '}';
                eval($abstract);
            }
            $this->reflection = $reflector = $this->reflectionInstance($mockAbstract);
        }


        if (method_exists($reflector, 'newInstanceWithoutConstructor'))
            return $reflector->newInstanceWithoutConstructor();

        $props = $reflector->getProperties();
        $defaults = $reflector->getDefaultProperties();
        $class = $reflector->getName();

        $serial = "O:" . strlen($class) . ":\"$class\":".count($props) .':{';
        foreach ($props as $prop) {
            $name = $prop->getName();
            if($prop->isProtected())
                $name = chr(0) . '*' .chr(0) .$name;
            elseif($prop->isPrivate())
                $name = chr(0)  . $class.  chr(0).$name;
            $serial .= serialize($name);
            if(array_key_exists($prop->getName(), $defaults) )
                $serial .= serialize($defaults[$prop->getName()]);
            else
                $serial .= serialize(null);
        }
        $serial .="}";
        return unserialize($serial);
    }

    public static function hasSupport($target)
    {
        return is_string($target) && class_exists($target);
    }
}
