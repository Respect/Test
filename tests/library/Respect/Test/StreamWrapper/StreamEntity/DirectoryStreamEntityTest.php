<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

/**
 * @covers Respect\Test\StreamWrapper\StreamEntity\DirectoryStreamEntity
 */
class DirectoryStreamEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DirectoryStreamEntity local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = new DirectoryStreamEntity;
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamEntity\DirectoryStreamEntity::getStat
     */
    public function testGetStat()
    {
        $stat = null;
        $expected = array('size' => 0);
        $result = $this->object->getStat($stat);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }
}
