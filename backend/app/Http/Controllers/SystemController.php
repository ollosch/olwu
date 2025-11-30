<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystemRequest;
use App\Http\Requests\UpdateSystemRequest;
use App\Models\System;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class SystemController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', System::class);

        return response()->json($request->user()->systems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSystemRequest $request): JsonResponse
    {
        Gate::authorize('create', System::class);

        $system = $request->user()->systems()->create($request->validated());

        return response()->json($system, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(System $system): JsonResponse
    {
        Gate::authorize('view', $system);

        return response()->json($system);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemRequest $request, System $system): JsonResponse
    {
        Gate::authorize('update', $system);

        $system->update($request->validated());

        return response()->json($system);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(System $system): JsonResponse
    {
        Gate::authorize('delete', $system);

        $system->delete();

        return response()->json(null, 204);
    }
}
