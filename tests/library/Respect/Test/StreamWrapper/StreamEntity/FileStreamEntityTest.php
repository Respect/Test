<?php
namespace Respect\Test\StreamWrapper\StreamEntity;
include_once __DIR__.'/StreamEntityTest.php';

/**
 * @covers Respect\Test\StreamWrapper\StreamEntity\FileStreamEntity
 */
class FileStreamEntityTest extends StreamEntityTest
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
