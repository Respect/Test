<?php
namespace Respect\Test\Reflection;
include_once dirname(__DIR__).'/ReflectTest.php';

use Respect\Test\Reflect;

/**
 * @covers Respect\Test\Reflection\ReflectClass
 */
class ReflectClassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReflectClass local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = new ReflectClass('Respect\\Test\\TestGuy');
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\Reflection\ReflectClass::__get
     */
    public function test__get()
    {
        $name = 'target';
        $expected = 'Respect\\Test\\TestGuy';
        $result = $this->object->__get($name);
        $this->assertInstanceOf($expected, $result);
    }

    /**
     * @covers Respect\Test\Reflection\ReflectClass::hasSupport
     */
    public function testHasSupport()
    {
        $target = 'Respect\\Test\\TestGuy';
        $result = $this->object->hasSupport($target);
        $this->assertTrue($result);
    }
}
