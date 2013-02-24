<?php
namespace Respect\Test;

class TestGuy
{
    private             $pvt    = 'private';
    protected           $prt    = 'protected';
    public              $pub    = 'public';
    private   static    $spvt   = 'static private';
    protected static    $sprt   = 'static protected';
    public    static    $spub   = 'static public';

    public function __construct(&$ref)
    {
        $this->pub = $ref;
        $ref = 'Testing guy';
    }

    public static function reset()
    {
        static::$spvt   = 'static private';
        static::$sprt   = 'static protected';
        static::$spub   = 'static public';
    }
}
/**
 * @covers Respect\Test\Reflect
 */
class ReflectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Reflect local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = Reflect::on('Respect\\Test\\TestGuy');
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
        TestGuy::reset();
        $this->object = null;
    }

    /**
     * @covers Respect\Test\Reflect::on
     */
    public function testOn()
    {
        $expected = 'Respect\\Test\\Reflect';
        $result = Reflect::on('Respect\\Test\\TestGuy');
        $this->assertInstanceOf($expected, $result);
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
     * @covers Respect\Test\Reflect::setProperty
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
     * @covers Respect\Test\Reflect::getProperty
     */
    public function testGetProperty($name, $expected)
    {
        $result = $this->object->getProperty($name);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\Reflect::getInstance
     */
    public function testReflectGetInstance()
    {
        $expected = 'Respect\\Test\\TestGuy';
        $result = $this->object->getInstance();
        $this->assertInstanceOf($expected, $result);
    }

    public function testReflectGetInstancePassConstructorParameterByReference()
    {
        $expected = 'Testing guy';
        $value = 'result';
        $this->object->getInstance(array(&$value));
        $this->assertEquals($expected, $value);
    }

    public function testReflectGetInstancePassingValueToConstructor()
    {
        $expected = $value = 'result';
        $result = $this->object->getInstance(array(&$value));
        $this->assertEquals($expected, $result->pub);
    }
}
