<?php

declare(strict_types=1);

use App\Models\Module;
use App\Models\System;
use Carbon\CarbonImmutable;

test('to array', function (): void {
    $system = Module::factory()->create()->refresh();

    expect(array_keys($system->toArray()))
        ->toBe([
            'id',
            'system_id',
            'type',
            'name',
            'description',
            'created_at',
            'updated_at',
        ]);
});

test('casts attributes correctly', function (): void {
    $module = Module::factory()->create();

    expect($module->id)->toBeInt()
        ->and($module->system_id)->toBeInt()
        ->and($module->type)->toBeString()
        ->and($module->name)->toBeString()
        ->and($module->description)->toBeString()
        ->and($module->created_at)->toBeInstanceOf(CarbonImmutable::class)
        ->and($module->updated_at)->toBeInstanceOf(CarbonImmutable::class);
});

test('belongs to system', function (): void {
    $system = System::factory()->create();
    $module = Module::factory()->create(['system_id' => $system->id]);

    expect($module->system)->toBeInstanceOf(System::class)
        ->and($module->system->id)->toBe($system->id);
});
