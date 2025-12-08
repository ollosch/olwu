<?php

declare(strict_types=1);

use App\Models\Module;
use App\Models\Role;
use App\Models\System;
use App\Models\SystemIndex;
use App\Models\User;
use Carbon\CarbonImmutable;

test('to array', function (): void {
    $system = System::factory()->create()->refresh();

    expect(array_keys($system->toArray()))
        ->toBe([
            'id',
            'owner_id',
            'name',
            'description',
            'created_at',
            'updated_at',
        ]);
});

test('casts attributes correctly', function (): void {
    $system = System::factory()->create();

    expect($system->id)->toBeString()->toHaveLength(26)
        ->and($system->owner_id)->toBeString()->toHaveLength(26)
        ->and($system->name)->toBeString()
        ->and($system->description)->toBeString()
        ->and($system->created_at)->toBeInstanceOf(CarbonImmutable::class)
        ->and($system->updated_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('has an owner', function (): void {
    $user = User::factory()->create();
    $system = System::factory()->create(['owner_id' => $user->id]);

    expect($system->owner)->toBeInstanceOf(User::class)
        ->and($system->owner->id)->toBe($user->id);
});

test('has many modules', function (): void {
    $system = System::factory()->create();
    $module = Module::factory()->create(['system_id' => $system->id]);

    expect($system->modules)->toHaveCount(1)
        ->first()
            ->toBeInstanceOf(Module::class)
            ->and($module->id)->toBeIn($system->modules->pluck('id'));
});

test('has many system indices', function (): void {
    $system = System::factory()->create();
    $indexEntries = $system->systemIndices()->saveMany(
        SystemIndex::factory()->count(2)->make()
    );

    expect($system->systemIndices)->toHaveCount(2)
        ->each
        ->toBeInstanceOf(SystemIndex::class)
        ->and($system->systemIndices->modelKeys())
        ->toEqualCanonicalizing($indexEntries->modelKeys());
});

test('has many roles', function (): void {
    $system = System::factory()->create();
    $roleCount = $system->roles()->count();
    $role = Role::factory()->create(['system_id' => $system->id]);

    expect($system->roles)->toHaveCount($roleCount + 1)
        ->each
        ->toBeInstanceOf(Role::class)
        ->and($system->roles()->latest()->first()->id)
        ->toBe($role->id);
});
