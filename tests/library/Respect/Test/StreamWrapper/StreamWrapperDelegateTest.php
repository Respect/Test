<?php
namespace Respect\Test\StreamWrapper;

use Respect\Test\StreamWrapper;
use ReflectionClass;
/**
 * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate
 */
class StreamWrapperDelegateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StreamWrapperDelegate local instance
     */
    protected $object;

    /**
     * Setting up the stage before our unit tests run.
     */
    protected function setUp()
    {
        StreamWrapper::setStreamOverrides(array());
        $class = new ReflectionClass('Respect\Test\StreamWrapper');
        $props=$class->getStaticProperties();
        $this->object = $props['wrapper'];
            //new StreamWrapperDelegate(array(), 'Respect\Test\StreamWrapper');
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::__destruct
     */
    public function test__destruct()
    {
        $expected = '';
        $result = $this->object->__destruct();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::errorHandler
     */
    public function testErrorHandler()
    {
        $result = $this->object->errorHandler();
        $this->assertTrue($result);
        $this->object->url_stat('.', STREAM_URL_STAT_QUIET);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_open
     */
    public function testStream_open()
    {
        $path = null;
        $mode = null;
        $options = null;
        $opened_path = null;
        $expected = '';
        $result = $this->object->stream_open($path, $mode, $options, $opened_path);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_close
     */
    public function testStream_close()
    {
        $expected = '';
        $result = $this->object->stream_close();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_flush
     */
    public function testStream_flush()
    {
        $expected = '';
        $result = $this->object->stream_flush();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_stat
     */
    public function testStream_stat()
    {
        $expected = '';
        $result = $this->object->stream_stat();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_read
     */
    public function testStream_read()
    {
        $length = null;
        $expected = '';
        $result = $this->object->stream_read($length);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_eof
     */
    public function testStream_eof()
    {
        $expected = '';
        $result = $this->object->stream_eof();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::statOut
     */
    public function testStatOut()
    {
        $stat = null;
        $expected = '';
        $result = $this->object->statOut($stat);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::url_stat
     */
    public function testUrl_stat()
    {
        $path = null;
        $flags = null;
        $expected = '';
        $result = $this->object->url_stat($path, $flags);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::dir_closedir
     */
    public function testDir_closedir()
    {
        $expected = '';
        $result = $this->object->dir_closedir();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::dir_opendir
     */
    public function testDir_opendir()
    {
        $path = null;
        $options = null;
        $expected = '';
        $result = $this->object->dir_opendir($path, $options);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::dir_readdir
     */
    public function testDir_readdir()
    {
        $expected = '';
        $result = $this->object->dir_readdir();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::dir_rewinddir
     */
    public function testDir_rewinddir()
    {
        $expected = '';
        $result = $this->object->dir_rewinddir();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::mkdir
     */
    public function testMkdir()
    {
        $path = null;
        $mode = null;
        $options = null;
        $expected = '';
        $result = $this->object->mkdir($path, $mode, $options);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::rename
     */
    public function testRename()
    {
        $path_from = null;
        $path_to = null;
        $expected = '';
        $result = $this->object->rename($path_from, $path_to);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::rmdir
     */
    public function testRmdir()
    {
        $path = null;
        $options = null;
        $expected = '';
        $result = $this->object->rmdir($path, $options);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_cast
     */
    public function testStream_cast()
    {
        $cast_as = null;
        $expected = '';
        $result = $this->object->stream_cast($cast_as);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_lock
     */
    public function testStream_lock()
    {
        $operation = null;
        $expected = '';
        $result = $this->object->stream_lock($operation);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_seek
     */
    public function testStream_seek()
    {
        $offset = null;
        $whence = null;
        $expected = '';
        $result = $this->object->stream_seek($offset, $whence);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_set_option
     */
    public function testStream_set_option()
    {
        $option = null;
        $arg1 = null;
        $arg2 = null;
        $expected = '';
        $result = $this->object->stream_set_option($option, $arg1, $arg2);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_tell
     */
    public function testStream_tell()
    {
        $expected = '';
        $result = $this->object->stream_tell();
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::stream_write
     */
    public function testStream_write()
    {
        $data = null;
        $expected = '';
        $result = $this->object->stream_write($data);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }

    /**
     * @covers Respect\Test\StreamWrapper\StreamWrapperDelegate::unlink
     */
    public function testUnlink()
    {
        $path = null;
        $expected = '';
        $result = $this->object->unlink($path);
        $this->assertEquals($expected, $result);
        $this->assertTrue(true);
        $this->assertFalse(false);
    }
}
