<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Actions;

use App\Domain\Notifications\Models\Notification;
use App\Exceptions\DomainException;
use Illuminate\Support\Facades\DB;

final class MarkNotificationAsRead
{
    public function execute(Notification $notification, ?int $userId = null): Notification
    {
        return DB::transaction(function () use ($notification, $userId): Notification {
            $locked = Notification::query()->lockForUpdate()->findOrFail($notification->getKey());
            if ($userId !== null && ((string) $locked->notifiable_id !== (string) $userId || $locked->notifiable_type !== \App\Domain\Employees\Models\User::class)) {
                throw new DomainException('You cannot modify another user’s notification.', 'NOTIFICATION_FORBIDDEN');
            }
            if ($locked->read_at === null) {
                $locked->forceFill(['read_at' => now()])->save();
            }
            return $locked->refresh();
        });
    }
}
