<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

final class NotificationService
{
    public function unreadCount(Model $user): int
    {
        return $user->unreadNotifications()->count();
    }

    public function markAsRead(DatabaseNotification $notification): void
    {
        $notification->markAsRead();
    }

    public function markAllAsRead(Model $user): void
    {
        $user->unreadNotifications()->update([
            'read_at' => now(),
        ]);
    }
}