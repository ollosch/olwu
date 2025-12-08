<?php

declare(strict_types=1);

use App\Models\Permission;
use App\Models\Role;
use App\Models\System;
use Carbon\CarbonInterface;

test('to array', function (): void {
    $role = Role::factory()->create()->refresh();

    expect(array_keys($role->toArray()))
        ->toBe([
            'id',
            'system_id',
            'name',
            'created_at',
            'updated_at',
        ]);
});

test('casts attributes correctly', function (): void {
    $role = Role::factory()->create();

    expect($role->id)->toBeString()->toHaveLength(26)
        ->and($role->system_id)->toBeString()->toHaveLength(26)
        ->and($role->name)->toBeString()
        ->and($role->created_at)->toBeInstanceOf(CarbonInterface::class)
        ->and($role->updated_at)->toBeInstanceOf(CarbonInterface::class);
});

test('has many permissions', function (): void {
    $role = Role::factory()->create();
    $role->permissions()->attach(
        Permission::factory()->count(2)->create()->pluck('id')->toArray()
    );

    expect($role->permissions)->toHaveCount(2)
        ->and($role->permissions)->each->toBeInstanceOf(Permission::class);
});

test('belongs to a system', function (): void {
    $system = System::factory()->create();
    $role = Role::factory()->create(['system_id' => $system->id]);

    expect($role->system)->toBeInstanceOf(System::class);
});
