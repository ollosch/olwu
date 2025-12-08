<?php

declare(strict_types=1);

use App\Enums\PermissionList;

test('assigns all permissions to a scope', function (): void {
    $case_count = count(PermissionList::cases());
    $permission_count =
        count(PermissionList::casesByScope('global')) +
        count(PermissionList::casesByScope('system')) +
        count(PermissionList::casesByScope('module'));

    expect($case_count)->toBe($permission_count);
});
