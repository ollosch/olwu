<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

Route::get('/', fn (): JsonResponse => new JsonResponse(['status' => 'ok']));
