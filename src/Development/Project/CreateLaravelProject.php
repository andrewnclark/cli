<?php

namespace Aero\Cli\Development\Project;

use Aero\Cli\NewCommand;
use Symfony\Component\Process\Process;

class CreateLaravelProject
{
    public function __construct(NewCommand $command, $path)
    {
        $this->command = $command;
        $this->path = $path;
    }

    public function install()
    {
        if (!file_exists(expand_tilde($this->path))) {
            mkdir(expand_tilde($this->path));
        }

        $process = new Process('cd '. expand_tilde($this->path) .';laravel new aero');

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}