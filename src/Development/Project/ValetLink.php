<?php

namespace Aero\Cli\Development\Project;

use Aero\Cli\NewCommand;
use Symfony\Component\Process\Process;

class ValetLink
{
    private $command;
    private $path;

    public function __construct(NewCommand $command, $path)
    {
        $this->command = $command;
        $this->path = expand_tilde($path);
    }

    public function install()
    {
        $valet = new Process('valet link', $this->path.'/aero');
        $valet->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
