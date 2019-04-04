<?php
namespace PHPMD\Writer;

use PHPMD\Writer\StreamWriter;
use PHPUnit\Framework\TestCase;

/**
 * Class StreamWriterTest
 * @package PHPMD\Writer
 * @covers \PHPMD\Writer\StreamWriter
 */
class StreamWriterTest extends TestCase
{

    /**
     * @test
     *
     **/
    public function constructTestStreamResource()
    {
        $stream = tmpfile();
        $obj = new StreamWriter($stream);
        $obj->write('foo/bar/baz');
        fseek($stream, 0);
        self::assertEquals('foo/bar/baz',fread($stream, 1024));
        fclose($stream);
    }
}
