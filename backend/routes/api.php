<?php

declare(strict_types=1);

use App\Http\Controllers\SystemController;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/me', fn (Request $request) => $request->user())
    ->middleware(['auth:sanctum'])
    ->name('me');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('systems', SystemController::class);
});

require __DIR__.'/auth.php';
