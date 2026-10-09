<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\ChangeUserPassword;
use App\Domain\Employees\Actions\ResetUserPassword;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\ChangeUserPasswordRequest;
use App\Http\Requests\Employees\ResetUserPasswordRequest;

final class UserPasswordController extends Controller
{
    public function change(
        ChangeUserPasswordRequest $request,
        User $user,
        ChangeUserPassword $action
    ): User {
        return $action->execute($user, $request->validated());
    }

    public function reset(
        ResetUserPasswordRequest $request,
        User $user,
        ResetUserPassword $action
    ): User {
        return $action->execute($user, $request->validated());
    }
}