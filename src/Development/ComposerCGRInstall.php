<?php

namespace Aero\Cli\Development;

use Aero\Cli\NewCommand;
use Symfony\Component\Process\Process;

class ComposerCGRInstall
{
    private $command;

    public function __construct(NewCommand $command)
    {
        $this->command = $command;
    }

    public function install()
    {
        $this->command->output->writeln("<info>Installing Composer CGR - Prevents Global Conflicts.</info>");
        $process = new Process('composer global require consolidation/cgr');

        $process->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}