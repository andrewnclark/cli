<?php

namespace Aero\Cli\Module;

use Aero\Cli\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NewModuleCommand extends Command
{
    protected $installers = [
        CreateDirectory::class,
        CopyStubs::class
    ];

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('module')
            ->setDescription('Scaffold a new Aero Commerce Module.')
            ->addArgument('module', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = new SymfonyStyle($input, $output);
        $this->path = $this->desiredModulePath($input);

        foreach ($this->installers as $installer) {
            (new $installer($this))->install();
        }


        return 0;
    }

    private function desiredModulePath(InputInterface $input)
    {
        return getcwd() . "/{$input->getArgument('module')}";
    }
}
