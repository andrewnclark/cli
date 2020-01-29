<?php

namespace Aero\Cli\Module;

use Aero\Cli\InstallStep;

class CreateDirectory extends InstallStep
{
    public function install()
    {
        if(file_exists($this->command->path)) {
            return;
        }

        mkdir($this->command->path);
    }
}