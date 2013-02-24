<?php
namespace Respect\Test\Reflection;
include_once dirname(__DIR__).'/ReflectTest.php';

use Respect\Test\Reflect, Respect\Test\TestGuy;

/**
 * @covers Respect\Test\Reflection\ReflectObject
 */
class ReflectObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReflectObject local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $value = 'public';
        $this->object = new ReflectObject(new TestGuy($value));
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
        TestGuy::reset();
        $this->object = null;
    }

    public function providerSetProperty()
    {
        return array(
            array('pvt', 1, 1),
            array('prt', 2, 2),
            array('pub', 3, 3),
            array('spvt', 4, 4),
            array('sprt', 5, 5),
            array('spub', 6, 6),
        );
    }

    /**
     * @dataProvider providerSetProperty
     * @covers Respect\Test\Reflection\ReflectObject::setProperty
     */
    public function testSetProperty($name, $value, $expected)
    {
        $this->object->setProperty($name, $value);
        $result = $this->object->getProperty($name);
        $this->assertEquals($expected, $result);
    }

    public function providerGetProperty()
    {
        return array(
            array('pvt', 'private'),
            array('prt', 'protected'),
            array('pub', 'public'),
            array('spvt', 'static private'),
            array('sprt', 'static protected'),
            array('spub', 'static public'),
        );
    }

    /**
     * @dataProvider providerGetProperty
     * @covers Respect\Test\Reflection\ReflectObject::getProperty
     */
    public function testGetProperty($name, $expected)
    {
        $result = $this->object->getProperty($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\Reflection\ReflectObject::hasSupport
     */
    public function testHasSupport()
    {
        $value = 'public';
        $target = new TestGuy($value);
        $result = $this->object->hasSupport($target);
        $this->assertTrue($result);
    }

    /**
     * @covers Respect\Test\Reflection\ReflectObject::getInstance
     */
    public function testGetInstance()
    {
        $expected = 'Respect\\Test\\TestGuy';
        $result = $this->object->getInstance();
        $this->assertInstanceOf($expected, $result);
    }

    public function testGetInstancePassConstructorParameterByReference()
    {
        $expected = 'Testing guy';
        $value = 'result';
        $this->object->getInstance(array(&$value));
        $this->assertEquals($expected, $value);
    }

    public function testGetInstancePassingValueToConstructor()
    {
        $expected = $value = 'result';
        $result = $this->object->getInstance(array(&$value));
        $this->assertEquals($expected, $result->pub);
    }
}
