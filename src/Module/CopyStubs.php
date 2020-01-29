<?php

namespace Aero\Cli\Module;

use Aero\Cli\InstallStep;
use Symfony\Component\Process\Process;

class CopyStubs extends InstallStep
{
    public function install()
    {
        $process = new Process([
            'cp',
            '-r',
            __DIR__ . "/stubs/",
            $this->command->path
        ]);

        $process->run();

        if (! $process->isSuccessful()) {
            $this->errorInstall();
        }
    }
}