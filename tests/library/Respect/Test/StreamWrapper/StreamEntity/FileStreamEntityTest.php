<?php
namespace Respect\Test\StreamWrapper\StreamEntity;

/**
 * @covers Respect\Test\StreamWrapper\StreamEntity\FileStreamEntity
 */
class FileStreamEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileStreamEntity local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        $this->object = new FileStreamEntity;
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }
}
