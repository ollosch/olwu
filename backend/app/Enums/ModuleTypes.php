<?php

declare(strict_types=1);

namespace App\Enums;

enum ModuleTypes: string
{
    case CORE = 'core';
    case PLUGIN = 'module';
}
