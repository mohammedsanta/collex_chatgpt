<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Actions;

use App\Domain\Employees\Models\User;
use App\Domain\Notifications\Models\Notification;
use App\Exceptions\DomainException;

final class DeleteNotification
{
    public function execute(Notification $notification, ?int $userId = null): void
    {
        if ($userId !== null && ((string) $notification->notifiable_id !== (string) $userId || $notification->notifiable_type !== User::class)) {
            throw new DomainException('You cannot delete another user’s notification.', 'NOTIFICATION_FORBIDDEN');
        }
        $notification->delete();
    }
}
