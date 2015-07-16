<?php

namespace Scabo\Console;


class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleCommandWithoutArgs()
    {
        $this->assertEquals('ls', (new Command('ls'))->render());
    }

    public function testArrayArgs()
    {
        $this->assertEquals("ls '-l'", (new Command('ls'))->addArgs(['-l'])->render());
        $this->assertEquals("ls '-l -v'", (new Command('ls'))->addArgs(['-l', '-v'])->render());
    }

    public function testStringArgs()
    {
        $this->assertEquals("ls '-l'", (new Command('ls'))->addArgs('-l')->render());
        $this->assertEquals("ls '-l -v'", (new Command('ls'))->addArgs('-l')->addArgs('-v')->render());
    }

    public function testExec()
    {
        $this->assertTrue(
            in_array('README.md', (new Command('ls'))->exec())
        );
    }

    public function testInvoke()
    {
        $ls = (new Command('ls'));
        $this->assertTrue(
            in_array('README.md', $ls())
        );
    }

    public function testToString()
    {
        $this->assertEquals('ls', (string) (new Command('ls')));
    }
}
