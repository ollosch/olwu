<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdatemoduleRequest;
use App\Models\Module;
use App\Models\System;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class ModuleController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request, System $system): JsonResponse
    {
        Gate::authorize('create', Module::class);

        $module = $system->modules()->create($request->validated());

        return response()->json($module, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module): JsonResponse
    {
        Gate::authorize('view', $module);

        return response()->json($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemoduleRequest $request, Module $module): JsonResponse
    {
        Gate::authorize('update', $module);

        $module->update($request->validated());

        return response()->json($module);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module): JsonResponse
    {
        Gate::authorize('delete', $module);

        $module->delete();

        return response()->json(null, 204);
    }
}
