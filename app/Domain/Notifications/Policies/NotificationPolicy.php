<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Policies;

use App\Domain\Employees\Models\User;
use App\Domain\Notifications\Models\Notification;

final class NotificationPolicy
{
    public function view(User $user, Notification $notification): bool
    {
        return (int) $notification->notifiable_id === (int) $user->getKey()
            && $notification->notifiable_type === User::class;
    }

    public function markAsRead(User $user, Notification $notification): bool
    {
        return $this->view($user, $notification);
    }

    public function delete(User $user, Notification $notification): bool
    {
        return $this->view($user, $notification);
    }
}