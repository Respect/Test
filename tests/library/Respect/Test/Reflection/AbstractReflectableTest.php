<?php
namespace Respect\Test\Reflection;

use Respect\Test\Reflect;
/**
 * @covers Respect\Test\Reflection\AbstractReflectable
 */
class AbstractReflectableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractReflectable local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = Reflect::on('Respect\\Test\\Reflection\\AbstractReflectable')->getInstance(array('panda'));
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\Reflection\AbstractReflectable::__get
     */
    public function test__get()
    {
        $name = 'target';
        $expected = 'panda';
        $result = $this->object->__get($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\Reflection\AbstractReflectable::__set
     */
    public function test__set()
    {
        $name = 'target';
        $value = $expected = 'happy panda';
        $this->object->__set($name, $value);
        $result = $this->object->__get($name);
        $this->assertEquals($expected, $result);
        $value = $expected = 'panda happy';
        $this->object->target = $value;
        $result = $this->object->__get($name);
        $this->assertEquals($expected, $result);
    }
}
