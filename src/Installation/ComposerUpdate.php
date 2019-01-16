<?php

namespace Aero\Cli\Installation;

use Aero\Cli\Command;
use Aero\Cli\InstallStep;
use Symfony\Component\Process\Process;

class ComposerUpdate extends InstallStep
{
    /**
     * Create a new installation helper instance.
     *
     * @param \Aero\Cli\Command $command
     */
    public function __construct(Command $command)
    {
        parent::__construct($command);

        $this->command->output->write('Fuelling Aero');
    }

    /**
     * Run the installation helper.
     *
     * @return void
     */
    public function install()
    {
        $process = (new Process(['composer', 'update', '--quiet'], $this->command->path))->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->command->output->write($line);
        });

        if (! $process->isSuccessful()) {
            $this->command->output->writeln(': <error>✘</error>');
            die(0);
        }

        $this->command->output->writeln(': <info>✔</info>');
    }
}
