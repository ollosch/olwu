<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\System;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class SystemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // TODO: Not sure here
        return $user->can('view.any.system');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, System $system): bool
    {
        // TODO: Set up relations
        return DB::table('role_user')
            ->where('user_id', $user->id)
            ->where('system_id', $system->id)
            ->exists() ||
            $user->can('view.any.system');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create.systems');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, System $system): bool
    {
        return
            $user->can('edit.system', $system) ||
            $user->can('edit.any.system');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, System $system): bool
    {
        return
            $user->can('delete.system', $system) ||
            $user->can('delete.any.system');
    }
}
