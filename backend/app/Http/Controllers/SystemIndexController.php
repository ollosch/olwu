<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystemIndexRequest;
use App\Http\Requests\UpdateSystemIndexRequest;
use App\Models\SystemIndex;

final class SystemIndexController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSystemIndexRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemIndex $systemIndex): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemIndexRequest $request, SystemIndex $systemIndex): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemIndex $systemIndex): void
    {
        //
    }
}
