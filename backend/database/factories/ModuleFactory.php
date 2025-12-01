<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ModuleTypes;
use App\Models\Module;
use App\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Module>
 */
final class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'system_id' => System::factory(),
            'type' => $this->faker->randomElement(ModuleTypes::cases())->value,
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
