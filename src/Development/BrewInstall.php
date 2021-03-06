<?php

namespace Aero\Cli\Development;

use Aero\Cli\DevCommand;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Process\Process;

class BrewInstall
{
    private $command;

    public function __construct(DevCommand $command)
    {
        $this->command = $command;
    }

    public function install()
    {
        $this->installBrew();

        $this->updateBrew();
    }

    /**
     * @return bool
     */
    private function brewDoesNotExist()
    {
        $process = new Process(['which', 'brew']);
        $process->run();

        return $process->getOutput() == '';
    }

    private function installBrew()
    {
        if ($this->brewDoesNotExist()) {
            $this->command->output->writeln('<info>Brew is required for Valet Plus</info>');

            $helper = $this->command->getHelper('question');
            $question = new ConfirmationQuestion('Install Brew? [Y\n]');

            if ($helper->ask($this->command->input, $this->command->output, $question)) {
                $process = new Process('/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"');

                $process->run(function ($type, $line) {
                    $this->command->output->write($line);
                });
            }
        }
    }

    private function updateBrew()
    {
        $update = new Process('brew update');
        $update->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
