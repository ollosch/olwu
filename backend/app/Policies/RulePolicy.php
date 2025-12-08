<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Module;
use App\Models\Rule;
use App\Models\User;

final class RulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): true
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rule $rule): true
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Module $module): bool
    {
        return
            $user->can('create.rules', $module) ||
            $user->can('create.any.rule', $module->system);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Module $module): bool
    {
        return
            $user->can('edit.rules', $module) ||
            $user->can('edit.any.rule', $module->system);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Module $module): bool
    {
        return
            $user->can('delete.rules', $module) ||
            $user->can('delete.any.rule', $module->system);
    }
}
