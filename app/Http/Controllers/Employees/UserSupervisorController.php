<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\AssignUserToSupervisor;
use App\Domain\Employees\Actions\RemoveUserFromSupervisor;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\AssignUserToSupervisorRequest;

final class UserSupervisorController extends Controller
{
    public function assign(
        AssignUserToSupervisorRequest $request,
        User $user,
        AssignUserToSupervisor $action
    ): User {
        return $action->execute($user, $request->validated());
    }

    public function remove(
        User $user,
        RemoveUserFromSupervisor $action
    ): User {
        return $action->execute($user);
    }
}