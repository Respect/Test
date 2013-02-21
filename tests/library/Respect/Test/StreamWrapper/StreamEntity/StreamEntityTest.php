<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

use Exception;
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
        $this->assertNull($this->object->getResource());
        $this->object->openResource();
        $this->assertNotNull($this->object->getResource());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getStat
     */
    public function testGetStat()
    {
        $result = $this->object->getStat();
        $this->assertEquals(26, count($result));
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::closeResource
     */
    public function testCloseResource()
    {
        $this->assertNull($this->object->getResource());
        $this->object->openResource();
        $this->assertNotNull($this->object->getResource());
        $this->object->closeResource();
        $this->assertNull($this->object->getResource());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::closeResource
     * @expectedException Exception
     */
    public function testCloseResourceExcept()
    {
        $this->object->closeResource();
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setOpen
     */
    public function testSetOpen()
    {
        $this->assertFalse($this->object->isOpen());
        $this->object->setOpen(true);
        $this->assertTrue($this->object->isOpen());
        $this->object->setOpen(false);
        $this->assertFalse($this->object->isOpen());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setMode
     */
    public function testSetMode()
    {
        $this->assertEquals('w+b', $this->object->getMode());
        $this->object->setMode('panda');
        $this->assertEquals('panda', $this->object->getMode());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getMode
     */
    public function testGetMode()
    {
        $this->assertEquals('w+b', $this->object->getMode());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::isOpen
     */
    public function testIsOpen()
    {
        $this->assertFalse($this->object->isOpen());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setData
     */
    public function testSetData()
    {
        $this->assertNull($this->object->getData());
        $this->object->setData('panda');
        $this->assertEquals('panda', $this->object->getData());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getData
     */
    public function testGetData()
    {
        $this->assertNull($this->object->getData());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getDataEncoded
     */
    public function testGetDataEncoded()
    {
        $expected = 'cGFuZGE=';
        $this->object->setData('panda');
        $result = $this->object->getDataEncoded();
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setUri
     */
    public function testSetUri()
    {
        $expected = 'data:text/plain;base64,';
        $result = $this->object->getUri();
        $this->assertEquals($expected, $result);
        $uri = 'panda';
        $this->object->setUri($uri);
        $result = $this->object->getUri();
        $this->assertEquals($uri, $result);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getDataUri
     */
    public function testGetDataUri()
    {
        $expected = 'data:text/plain;base64,';
        $result = $this->object->getDataUri();
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getUri
     */
    public function testGetUri()
    {
        $expected = 'data:text/plain;base64,';
        $result = $this->object->getUri();
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setPath
     */
    public function testSetPath()
    {
        $this->assertNull($this->object->getPath());
        $expected = getcwd().DIRECTORY_SEPARATOR.'panda';
        $path = 'panda';
        $this->object->setPath($path);
        $this->assertEquals($expected, $this->object->getPath());
        $expected = $_SERVER['HOME'].DIRECTORY_SEPARATOR.'panda';
        $path = '~/panda';
        $this->object->setPath($path);
        $this->assertEquals($expected, $this->object->getPath());
        $expected = $path = '/panda';
        $this->object->setPath($path);
        $this->assertEquals($expected, $this->object->getPath());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getPath
     */
    public function testGetPath()
    {
        $this->assertNull($this->object->getPath());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::setResource
     */
    public function testSetResource()
    {
        $this->assertNull($this->object->getResource());
        $resource = $expected = fopen($this->object->getDataUri(), $this->testGetMode());
        $this->object->setResource($resource);
        $this->assertEquals($expected, $this->object->getResource());
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\StreamEntity::getResource
     */
    public function testGetResource()
    {
        $this->assertNull($this->object->getResource());
    }
}
