<?php
namespace Respect\Test\Reflection;
include_once dirname(__DIR__).'/ReflectTest.php';

use Respect\Test\Reflect, Respect\Test\TestGuy;

/**
 * @covers Respect\Test\Reflection\ReflectionFactory
 */
class ReflectionFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReflectionFactory local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = new ReflectionFactory;
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\Reflection\ReflectionFactory::produce
     */
    public function testProduceReflectClass()
    {
        $target = 'Respect\\Test\\TestGuy';
        $expected = 'Respect\\Test\\Reflection\\ReflectClass';
        $result = $this->object->produce($target);
        $this->assertInstanceOf($expected, $result);
    }

    /**
     * @covers Respect\Test\Reflection\ReflectionFactory::produce
     */
    public function testProduceReflectObject()
    {
        $value = 'public';
        $target = new TestGuy($value);
        $expected = 'Respect\\Test\\Reflection\\ReflectObject';
        $result = $this->object->produce($target);
        $this->assertInstanceOf($expected, $result);
    }
}
