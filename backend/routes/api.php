<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/me', fn (Request $request) => $request->user())
    ->middleware(['auth:sanctum', 'verified'])
    ->name('me');

require __DIR__.'/auth.php';
