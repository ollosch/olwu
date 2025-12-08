<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Permission;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class CreateSystem
{
    public function execute(User $user, array $data): System
    {
        return DB::transaction(function () use ($user, $data): System {

            $system = $user->systems()->create($data);

            $system->modules()->create([
                'type' => 'core',
                'name' => 'Core Module',
                'description' => 'This is the core module and was created automatically.',
            ]);

            $roles = $system->roles()->createMany([
                ['name' => 'admin'],
                ['name' => 'module-admin'],
            ]);

            $roles[0]->permissions()->attach(Permission::system()->pluck('id')->toArray());
            $roles[1]->permissions()->attach(Permission::module()->pluck('id')->toArray());

            $user->assignRole('admin', $system);

            return $system;
        });
    }
}
