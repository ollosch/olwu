<?php

use App\Enums\PermissionList;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (PermissionList::casesByScope('global') as $permission) {
            Permission::factory()->create([
                'scope' => 'global',
                'name' => $permission->value,
            ]);
        }

        foreach (PermissionList::casesByScope('system') as $permission) {
            Permission::factory()->create([
                'scope' => 'system',
                'name' => $permission->value,
            ]);
        }

        foreach (PermissionList::casesByScope('module') as $permission) {
            Permission::factory()->create([
                'scope' => 'module',
                'name' => $permission->value,
            ]);
        }

        Role::factory()->create([
            'system_id' => null,
            'name' => 'admin'
        ])->permissions()->attach(Permission::global()->get()->pluck('id')->toArray());
    }
};
