<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\AssignUserToBank;
use App\Domain\Employees\Actions\RemoveUserFromBank;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\AssignUserToBankRequest;

final class UserBankController extends Controller
{
    public function assign(
        AssignUserToBankRequest $request,
        User $user,
        AssignUserToBank $action
    ): void {
        $action->execute($user, $request->validated());
    }

    public function remove(
        AssignUserToBankRequest $request,
        User $user,
        RemoveUserFromBank $action
    ): void {
        $action->execute($user, $request->validated());
    }
}