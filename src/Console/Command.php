<?php

namespace Scabo\Console;

/**
 * Class Command
 *
 * @package Caleo\Console
 */
class Command
{
    /**
     * Unix console command name, e.g. ls, cd, etc
     *
     * @var null|string
     */
    private $name = null;

    /**
     * List options that's passed to command
     *
     * @var array
     */
    private $args = [];

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Add agruments to command. You can pass the array of arguments or just an one command
     *
     * @param string|array $arg
     * @return $this
     */
    public function addArgs($arg)
    {
        if (is_array($arg)) {
            $this->args = array_merge($this->args, $arg);
        } else {
            $this->args[] = $arg;
        }

        return $this;
    }

    /**
     * Build command
     *
     * @return string
     */
    public function render()
    {
        if (empty($this->name)) return '';

        $options = '';
        foreach($this->args as $arg) {
            $options .= $arg . ' ';
        }

        if ($options) {
            $options = \escapeshellarg(trim($options));
        }

        return \trim($this->name . ' ' . $options);
    }

    /**
     * Execute command
     *
     * @return mixed
     */
    public function exec()
    {
        $output = null;
        \exec($this, $output);
        return $output;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->exec();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}