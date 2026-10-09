<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Actions;

use App\Domain\Notifications\Models\Notification;

final class MarkAllNotificationsAsRead
{
    public function execute(int $userId): int
    {
        return Notification::query()
            ->where('notifiable_type', \App\Domain\Employees\Models\User::class)
            ->where('notifiable_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
}
