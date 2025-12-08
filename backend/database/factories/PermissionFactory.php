<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PermissionList;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permission>
 */
final class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scope' => $this->faker->randomElement(['global', 'system', 'module']),
            'name' => implode('.', $this->faker->words(2, false)),
        ];
    }
}
