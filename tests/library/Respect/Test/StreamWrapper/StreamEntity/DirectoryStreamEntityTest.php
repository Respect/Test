<?php
namespace Respect\Test\StreamWrapper\StreamEntity;
include_once __DIR__.'/StreamEntityTest.php';

/**
 * @covers Respect\Test\StreamWrapper\StreamEntity\DirectoryStreamEntity
 */
class DirectoryStreamEntityTest extends StreamEntityTest
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
        $result = $this->object->getStat();
        $this->assertEquals(0, $result['size']);
        parent::testGetStat();
    }
}
