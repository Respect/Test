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
        ob_start();
        StreamWrapperVerbose::setStreamOverrides(array());
        StreamWrapperVerbose::releaseOverrides();
        $out = ob_get_clean();
        $this->assertNotEquals(false, $out);
        $this->assertContains('dir_closedir', $out);
    }

}
