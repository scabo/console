<?php

namespace Caleo\Console;

class Command
{
    private $name = null;

    private $args = [];

    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    public function addArgs($arg)
    {
        if (is_array($arg)) {
            $this->args = array_merge($this->args, $arg);
        } else {
            $this->args[] = $arg;
        }

        return $this;
    }

    public function render()
    {
        if (empty($this->name)) return '';

        $options = '';
        foreach($this->args as $arg) {
            $options .= $arg . ' ';
        }

        return \trim($this->name . ' ' . $options);
    }

    public function exec()
    {
        $output = null;
        exec($this, $output);
        return $output;
    }

    public function __invoke()
    {
        return $this->exec();
    }

    public function __toString()
    {
        return $this->render();
    }
}