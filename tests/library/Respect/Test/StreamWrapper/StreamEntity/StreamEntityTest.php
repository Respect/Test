<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

/**
 * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity
 */
class StreamEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StreamEntity local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = new StreamEntity;
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::openResource
     */
    public function testOpenResource()
    {
        $expected = '';
        $result = $this->object->openResource();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getStat
     */
    public function testGetStat()
    {
        $stat = null;
        $expected = '';
        $result = $this->object->getStat($stat);
        print_r($result);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::closeResource
     */
    public function testCloseResource()
    {
        $expected = '';
        $result = $this->object->closeResource();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setOpen
     */
    public function testSetOpen()
    {
        $open = null;
        $expected = '';
        $result = $this->object->setOpen($open);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setMode
     */
    public function testSetMode()
    {
        $mode = null;
        $expected = '';
        $result = $this->object->setMode($mode);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getMode
     */
    public function testGetMode()
    {
        $expected = 'w+b';
        $result = $this->object->getMode();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::isOpen
     */
    public function testIsOpen()
    {
        $expected = '';
        $result = $this->object->isOpen();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setData
     */
    public function testSetData()
    {
        $data = null;
        $expected = '';
        $result = $this->object->setData($data);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getData
     */
    public function testGetData()
    {
        $expected = '';
        $result = $this->object->getData();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getDataEncoded
     */
    public function testGetDataEncoded()
    {
        $expected = '';
        $result = $this->object->getDataEncoded();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setUri
     */
    public function testSetUri()
    {
        $uri = null;
        $expected = '';
        $result = $this->object->setUri($uri);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getDataUri
     */
    public function testGetDataUri()
    {
        $expected = 'data:text/plain;base64,';
        $result = $this->object->getDataUri();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getUri
     */
    public function testGetUri()
    {
        $expected = 'data:text/plain;base64,';
        $result = $this->object->getUri();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setPath
     */
    public function testSetPath()
    {
        $path = null;
        $expected = '';
        $result = $this->object->setPath($path);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getPath
     */
    public function testGetPath()
    {
        $expected = '';
        $result = $this->object->getPath();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setResource
     */
    public function testSetResource()
    {
        $resource = null;
        $expected = '';
        $result = $this->object->setResource($resource);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getResource
     */
    public function testGetResource()
    {
        $expected = '';
        $result = $this->object->getResource();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }
}
