<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\GrantPermissionToUser;
use App\Domain\Employees\Actions\RevokePermissionFromUser;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\GrantPermissionToUserRequest;

final class UserPermissionController extends Controller
{
    public function grant(
        GrantPermissionToUserRequest $request,
        User $user,
        GrantPermissionToUser $action
    ): void {
        $action->execute($user, $request->validated());
    }

    public function revoke(
        GrantPermissionToUserRequest $request,
        User $user,
        RevokePermissionFromUser $action
    ): void {
        $action->execute($user, $request->validated());
    }
}