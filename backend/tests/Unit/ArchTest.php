<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;

arch()->preset()->php();
arch()->preset()->strict();
arch()->preset()->security()
    ->ignoring(AppServiceProvider::class);

arch('controllers')
    ->expect('App\Http\Controllers')
    ->not->toBeUsed();
