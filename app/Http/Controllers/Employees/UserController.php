<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\CreateUser;
use App\Domain\Employees\Actions\DeleteUser;
use App\Domain\Employees\Actions\UpdateUser;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\CreateUserRequest;
use App\Http\Requests\Employees\UpdateUserRequest;

final class UserController extends Controller
{
    public function store(CreateUserRequest $request, CreateUser $action): User
    {
        return $action->execute($request->validated());
    }

    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUser $action
    ): User {
        return $action->execute($user, $request->validated());
    }

    public function destroy(User $user, DeleteUser $action): void
    {
        $action->execute($user);
    }
}