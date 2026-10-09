<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\AssignUserRole;
use App\Domain\Employees\Actions\ChangeUserRole;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\AssignUserRoleRequest;

final class UserRoleController extends Controller
{
    public function assign(
        AssignUserRoleRequest $request,
        User $user,
        AssignUserRole $action
    ): User {
        return $action->execute($user, $request->validated());
    }

    public function change(
        AssignUserRoleRequest $request,
        User $user,
        ChangeUserRole $action
    ): User {
        return $action->execute($user, $request->validated());
    }
}