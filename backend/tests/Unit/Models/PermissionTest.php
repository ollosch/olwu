<?php

declare(strict_types=1);

use App\Enums\PermissionList;
use App\Models\Permission;

test('to array', function (): void {
    $permission = Permission::factory()->create()->refresh();

    expect(array_keys($permission->toArray()))
        ->toBe([
            'id',
            'scope',
            'name',
        ]);
});

test('casts attributes correctly', function (): void {
    $permission = Permission::factory()->create();

    expect($permission->id)->toBeString()->toHaveLength(26)
        ->and($permission->scope)->toBeString()
        ->and($permission->name)->toBeString();
});

test('global scope works', function (): void {
    $before = Permission::global()->count();
    Permission::factory()->create(['scope' => 'global']);
    Permission::factory()->create(['scope' => 'system']);

    $permissions = Permission::global()->get();

    expect($permissions)->toHaveCount($before + 1)
        ->and($permissions->last()->scope)->toBe('global');
});

test('system scope works', function (): void {
    $before = Permission::system()->count();
    Permission::factory()->create(['scope' => 'system']);
    Permission::factory()->create(['scope' => 'module']);

    $permissions = Permission::system()->get();

    expect($permissions)->toHaveCount($before + 1)
        ->and($permissions->last()->scope)->toBe('system');
});

test('module scope works', function (): void {
    $before = Permission::module()->count();
    Permission::factory()->create(['scope' => 'module']);
    Permission::factory()->create(['scope' => 'global']);

    $permissions = Permission::module()->get();

    expect($permissions)->toHaveCount($before + 1)
        ->and($permissions->last()->scope)->toBe('module');
});
