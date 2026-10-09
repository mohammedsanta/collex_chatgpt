<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Actions\DeactivateUser;
use App\Domain\Employees\Actions\ReactivateUser;
use App\Domain\Employees\Actions\SuspendUser;
use App\Domain\Employees\Models\User;
use App\Http\Controllers\Controller;

final class UserStatusController extends Controller
{
    public function deactivate(User $user, DeactivateUser $action): User
    {
        return $action->execute($user);
    }

    public function reactivate(User $user, ReactivateUser $action): User
    {
        return $action->execute($user);
    }

    public function suspend(User $user, SuspendUser $action): User
    {
        return $action->execute($user);
    }
}