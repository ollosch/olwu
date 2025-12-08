<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Permission;
use App\Models\Role;
use App\Models\System;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final readonly class CreateSystem
{
    /**
     * @param User $user
     * @param array<string, mixed> $data
     */
    public function execute(User $user, array $data): System
    {
        return DB::transaction(function () use ($user, $data): System {

            $system = $user->systems()->create($data);

            $system->modules()->create([
                'type' => 'core',
                'name' => 'Core Module',
                'description' => 'This is the core module and was created automatically.',
            ]);

            $systemAdminRole = $system->roles()->create(['name' => 'admin']);
            $systemAdminRole->permissions()->attach(Permission::system()->pluck('id')->toArray());

            $moduleAdminRole = $system->roles()->create(['name' => 'module_admin']);
            $moduleAdminRole->permissions()->attach(Permission::module()->pluck('id')->toArray());

            $user->assignRole('admin', $system);

            return $system;
        });
    }
}
