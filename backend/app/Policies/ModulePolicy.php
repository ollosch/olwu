<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Module;
use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    public function view(User $user, Module $Module): bool
    {

        // TODO: Set up relations
        return DB::table('role_user')
            ->where('user_id', $user->id)
            ->where('module_id', $Module->id)
            ->exists() ||
            $user->can('view.any.module', $Module->system);
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
    public function update(User $user, Module $Module): bool
    {
        return
            $user->can('edit.module', $Module) ||
            $user->can('edit.any.module', $Module->system);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Module $Module): bool
    {
        return
            $user->can('delete.module', $Module) ||
            $user->can('delete.any.module', $Module->system);
    }
}
