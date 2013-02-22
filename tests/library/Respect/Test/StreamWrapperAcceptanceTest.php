<?php
namespace Respect\Test;

use Respect\Test\StreamWrapper\StreamEntity\DirectoryStreamEntity;
use Respect\Test\StreamWrapper\StreamEntity\FileStreamEntity;
use DirectoryIterator;
/**
 * Testing functionality not coverage
 */
class StreamWrapperAcceptanceTest extends \PHPUnit_Framework_TestCase
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
        StreamWrapper::setStreamOverrides(array());
        $this->object = new StreamWrapper;
    }

    /**
     * Tearing thing down once test execution is done.
     */
    protected function tearDown()
    {
        StreamWrapper::releaseOverrides();
        stream_wrapper_restore('file');
        $this->object = null;
    }

    /** Test file_put_contents file_get_contents */
    public function testFilePutGetContents()
    {
        file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
        $this->assertEquals('Happy Pandas', file_get_contents('virtual/abc/test.txt'));
    }

    /** Test scandir */
    public function testScandir()
    {
        $expected = 'abc';
        file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
        $result = scandir('virtual');
        $this->assertEquals($expected, array_pop($result));
        $result = scandir('virtual/../virtual');
        $this->assertEquals($expected, array_pop($result));
        $result = scandir('./virtual');
        $this->assertEquals($expected, array_pop($result));
        $result = scandir('.');
        $this->assertEquals('virtual', array_pop($result));
    }

    /** Test DirectoryIterator */
    public function testDirectoryIterator()
    {
        $dir = new DirectoryStreamEntity;
        $file = new FileStreamEntity;
        file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
        $it = new DirectoryIterator('virtual');
        $cnt = 0;
        $path = '';
        foreach ($it as $item) {
            if ($cnt == 0) {
                $this->assertEquals('.', $item->getBasename());
//                $this->assertTrue($item->isDot());
            }
            elseif ($cnt == 1) {
                $this->assertEquals('..', $item->getBasename());
//                $this->assertTrue($item->isDot());
            }
            elseif ($cnt == 2) {
                $this->assertEquals('abc', $item->getBasename());
                $this->assertTrue($it->isDir());
                $this->assertFalse($it->isFile());
                $this->assertEquals($dir->getGid(), $it->getGroup());
                $this->assertEquals($dir->getUid(), $it->getOwner());
                $expected = sprintf('%o', $dir->getPermissions());
                $result = substr(sprintf('%o', $it->getPerms()), -3);
                $this->assertEquals($expected, $result);
                $path = $item->getPath() .DIRECTORY_SEPARATOR . $item->getBasename();
            }
            $cnt++;
        }
        $it = new DirectoryIterator($path);
        $it->seek(2);
        $item = $it->current();
        $this->assertEquals('test.txt', $item->getBasename());
        $this->assertFalse($item->isDir());
        $this->assertTrue($item->isFile());
        $this->assertEquals($file->getGid(), $item->getGroup());
        $this->assertEquals($file->getUid(), $item->getOwner());
        $expected = sprintf('%o', $file->getPermissions());
        $result = substr(sprintf('%o', $item->getPerms()), -3);
        $this->assertEquals($expected, $result);
    }

    /** test dir Directory */
//    public function testDirDirectoryObject()
//    {
//        file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
//        $dir = dir('virtual');
//        var_export($dir);
//        $this->assertEquals('.', $dir->read());
//        $this->assertEquals('..', $dir->read());
//        $this->assertEquals('abc', $dir->read());
//        $this->assertFalse($dir->read());
//        $dir->rewind();
//        $this->assertEquals('.', $dir->read());
//        $this->assertEquals('..', $dir->read());
//        $this->assertEquals('abc', $dir->read());
//        $this->assertFalse($dir->read());
//        $this->assertNotNull($dir->handle);
//        $dir->close();
////        $this->assertNull($dir->handle);
//    }

    /** Test opendir readdir */
//    public function testOpendir()
//    {
//        file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
//        $h = opendir('virtual');
//        var_export($h);
//        $this->assertEquals('.', readdir($h));
//        $this->assertEquals('..', readdir($h));
//        $this->assertEquals('abc', readdir($h));
//        $this->assertFalse(readdir($h));
//        rewinddir($h);
//        $this->assertEquals('.', readdir($h));
//        $this->assertEquals('..', readdir($h));
//        $this->assertEquals('abc', readdir($h));
//        $this->assertFalse(readdir($h));
//        $this->assertNotNull($h);
//        closedir($h);
////        $this->assertNull($h);
//    }

    /** Test stat */
    public function testStat()
    {
        $size = file_put_contents('virtual/abc/test.txt', 'Happy Pandas');
        $this->assertEquals($size, filesize('virtual/abc/test.txt'));
        $this->assertEquals(0, filesize('virtual/abc'));
        $this->assertFileExists('virtual/abc');
        $this->assertTrue(file_exists('virtual/abc'));
        $this->assertTrue(is_dir('virtual/abc'));
        $this->assertEquals('dir', filetype('virtual/abc'));
        $this->assertFileExists('virtual/abc/test.txt');
        $this->assertTrue(file_exists('virtual/abc/test.txt'));
        $this->assertTrue(is_file('virtual/abc/test.txt'));
        $this->assertTrue(is_writeable('virtual/abc/test.txt'));
        $this->assertTrue(is_readable('virtual/abc/test.txt'));
        $this->assertEquals('file', filetype('virtual/abc/test.txt'));
//        rename('virtual/abc/test.txt', 'virtual/abc/test2.txt');
//        $this->assertFileExists('virtual/abc/test2.txt');
//        $this->assertFileEquals('virtual/abc/test.txt', 'virtual/abc/test2.txt');
//        $this->assertEquals('Happy Pandas', file_get_contents('virtual/abc/test2.txt'));
//        copy('virtual/abc/test.txt', 'virtual/abc/test2.txt');
//        $this->assertFileExists('virtual/abc/test3.txt');
//        $this->assertFileEquals('virtual/abc/test.txt', 'virtual/abc/test3.txt');
//        $this->assertEquals('Happy Pandas', file_get_contents('virtual/abc/test3.txt'));
        unlink('virtual/abc/test2.txt');
        $this->assertFileNotExists('virtual/abc/test2.txt');
        rmdir('virtual/abc');
        $this->assertFalse(file_exists('virtual/abc'));
    }

}
