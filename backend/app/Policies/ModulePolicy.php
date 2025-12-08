<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\module;
use App\Models\System;
use App\Models\User;

final class ModulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // TODO: Not sure here
        return $user->can('view.any.modules');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, module $module): bool
    {

        // TODO: Set up relations
        return DB::table('role_user')
            ->where('user_id', $user->id)
            ->where('module_id', $module->id)
            ->exists() ||
            $user->can('view.any.module', $module->system);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, System $system): bool
    {
        return $user->can('create.modules', $system);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, module $module): bool
    {
        return
            $user->can('edit.module', $module) ||
            $user->can('edit.any.module', $module->system);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, module $module): bool
    {
        return
            $user->can('delete.module', $module) ||
            $user->can('delete.any.module', $module->system);
    }
}
