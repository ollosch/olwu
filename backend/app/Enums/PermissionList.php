<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionList: string
{
    // // Get all roles for user in this system (both system-level and module-level)
    // $roles = DB::table('role_user')
    //     ->where('user_id', $user->id)
    //     ->where('system_id', $system->id)
    //     ->join('roles', 'role_user.role_id', '=', 'roles.id')
    //     ->select('role_user.*', 'roles.permissions')
    //     ->get();

    // return [
    //     'system' => $roles->whereNull('module_id')->first()?->permissions,
    //     'modules' => $roles->whereNotNull('module_id')
    //         ->mapWithKeys(fn($r) => [$r->module_id => $r->permissions]),
    // ];

    // Global permissions
    case MANAGE_GLOBAL_ROLES = 'manage.global.roles';
    case MANAGE_USERS = 'manage.users';
    case CREATE_SYSTEMS = 'create.systems';
    case VIEW_ANY_SYSTEM = 'view.any.system';
    case EDIT_ANY_SYSTEM = 'edit.any.system';
    case MANAGE_ANY_SYSTEM = 'manage.any.system';
    case DELETE_ANY_SYSTEM = 'delete.any.system';

    // System Permissions: Require System Membership
    case MANAGE_SYSTEM_ROLES = 'manage.system.roles';
    case EDIT_SYSTEM = 'edit.system';
    case MANAGE_SYSTEM = 'manage.system';
    case DELETE_SYSTEM = 'delete.system';
    case CREATE_MODULES = 'create.modules';
    case VIEW_ANY_MODULE = 'view.any.module';
    case EDIT_ANY_MODULE = 'edit.any.module';
    case MANAGE_ANY_MODULE = 'manage.any.module';
    case DELETE_ANY_MODULE = 'delete.any.module';
    case CREATE_ANY_RULE = 'create.any.rule';
    case EDIT_ANY_RULE = 'edit.any.rule';
    case DELETE_ANY_RULE = 'delete.any.rule';

    // Module Permissions: Require Module Subscription
    case EDIT_MODULE = 'edit.module';
    case MANAGE_MODULE = 'manage.module';
    case DELETE_MODULE = 'delete.module';
    case CREATE_RULES = 'create.rules';
    case EDIT_RULES = 'edit.rules';
    case DELETE_RULES = 'delete.rules';

    /** @return array<PermissionList> */
    public static function casesByScope(string $scope): array
    {
        return match($scope) {
            'global' => [
                self::MANAGE_GLOBAL_ROLES,
                self::MANAGE_USERS,
                self::CREATE_SYSTEMS,
                self::VIEW_ANY_SYSTEM,
                self::EDIT_ANY_SYSTEM,
                self::MANAGE_ANY_SYSTEM,
                self::DELETE_ANY_SYSTEM,
            ],
            'system' => [
                self::MANAGE_SYSTEM_ROLES,
                self::EDIT_SYSTEM,
                self::MANAGE_SYSTEM,
                self::DELETE_SYSTEM,
                self::CREATE_MODULES,
                self::VIEW_ANY_MODULE,
                self::EDIT_ANY_MODULE,
                self::MANAGE_ANY_MODULE,
                self::DELETE_ANY_MODULE,
                self::CREATE_ANY_RULE,
                self::EDIT_ANY_RULE,
                self::DELETE_ANY_RULE,
            ],
            'module' => [
                self::EDIT_MODULE,
                self::MANAGE_MODULE,
                self::DELETE_MODULE,
                self::CREATE_RULES,
                self::EDIT_RULES,
                self::DELETE_RULES,
            ],
            default => [],
        };
    }
}
