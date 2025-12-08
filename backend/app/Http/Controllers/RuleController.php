<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuleRequest;
use App\Http\Requests\UpdateRuleRequest;
use App\Models\Rule;

final class RuleController
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
    public function store(StoreRuleRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRuleRequest $request, Rule $rule): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule): void
    {
        //
    }
}
