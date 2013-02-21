<?php
namespace Respect\Test;

/**
 * @covers Respect\Test\StreamWrapperVerbose
 */
class StreamWrapperVerboseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Respect\Test\StreamWrapperVerbose::__call
     */
    public function test__call()
    {
        StreamWrapper::setStreamOverrides(array(
            'virtual/foo-bar-baz.ini' => "foo=bar\nbaz=bat",
            'virtual/happy-panda.ini' => "panda=happy\nhappy=panda",
        ));
        $this->assertTrue(is_dir('virtual'));
        $this->assertTrue(file_exists('virtual/happy-panda.ini'));
        $this->assertEquals("foo=bar\nbaz=bat", file_get_contents('virtual/foo-bar-baz.ini'));
    }
}
