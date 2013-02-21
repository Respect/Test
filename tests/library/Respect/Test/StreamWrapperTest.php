<?php
namespace Respect\Test;

/**
 * @covers Respect\Test\StreamWrapper
 */
class StreamWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Respect\Test\StreamWrapper::setStreamOverrides
     */
    public function testSetStreamOverrides()
    {
        StreamWrapper::setStreamOverrides(array(
            'virtual/foo-bar-baz.ini' => "foo=bar\nbaz=bat",
            'virtual/happy-panda.ini' => "panda=happy\nhappy=panda",
        ));
        $this->assertTrue(is_dir('virtual'));
        $this->assertTrue(file_exists('virtual/happy-panda.ini'));
        $this->assertEquals("foo=bar\nbaz=bat", file_get_contents('virtual/foo-bar-baz.ini'));
    }

    /**
     * @covers Respect\Test\StreamWrapper::__call
     * @depends testSetStreamOverrides
     * @expectedException Exception
     * @expectedExceptionMessage No method implemented for unknown
     */
    public function test__call()
    {
        $sw = new StreamWrapper;
        $sw->unknown();
    }

    /**
     * @covers Respect\Test\StreamWrapper::releaseOverrides
     * @depends test__call
     */
    public function testReleaseOverrides()
    {
        StreamWrapper::releaseOverrides();
        $this->assertFalse(is_dir('virtual'));
        $this->assertFalse(file_exists('virtual/happy-panda.ini'));
    }

    /**
     * @covers Respect\Test\StreamWrapper::__call
     * @depends testReleaseOverrides
     * @expectedException Exception
     * @expectedExceptionMessage First inject stream overrides.
     */
    public function test__callInjectionRequired()
    {
        $sw = new StreamWrapper;
        $sw->unknown();
    }
}
