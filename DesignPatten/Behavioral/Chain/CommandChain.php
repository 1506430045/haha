<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/16
 * Time: 下午8:32
 */
namespace DesignPatten\Behavioral\Chain;

class CommandChain
{
    private $_commands = [];

    public function addCommand(Command $command)
    {
        $this->_commands[] = $command;
    }

    public function runCommand($name, $args)
    {
        foreach ($this->_commands as $command) {
            if ($command->onCommand($name, $args)) {
                return;
            }
        }
    }


}