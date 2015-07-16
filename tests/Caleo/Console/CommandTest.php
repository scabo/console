<?php

namespace Caleo\Console;


class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleCommandWithoutArgs()
    {
        $this->assertEquals('ls', (new Command('ls'))->render());
    }

    public function testArrayArgs()
    {
        $this->assertEquals('ls -l', (new Command('ls'))->addArgs(['-l'])->render());
        $this->assertEquals('ls -l -v', (new Command('ls'))->addArgs(['-l', '-v'])->render());
    }

    public function testStringArgs()
    {
        $this->assertEquals('ls -l', (new Command('ls'))->addArgs('-l')->render());
        $this->assertEquals('ls -l -v', (new Command('ls'))->addArgs('-l')->addArgs('-v')->render());
    }

    public function testExec()
    {
        $this->assertEquals(
            ['composer.json', 'composer.lock', 'phpunit.xml', 'src', 'tests', 'vendor'], (new Command('ls'))->exec()
        );
    }

    public function testInvoke()
    {
        $ls = (new Command('ls'));
        $this->assertEquals(
            ['composer.json', 'composer.lock', 'phpunit.xml', 'src', 'tests', 'vendor'], $ls()
        );
    }

    public function testToString()
    {
        $this->assertEquals('ls', (string) (new Command('ls')));
    }
}
