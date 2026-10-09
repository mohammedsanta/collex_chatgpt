<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Actions;

use App\Domain\Notifications\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreNotification
{
    public function execute(string $notificationId): Notification
    {
        try {
            return DB::transaction(function () use ($notificationId): Notification {
                $notification = Notification::query()
                    ->lockForUpdate()
                    ->findOrFail($notificationId);

                if ($notification->read_at !== null) {
                    throw new \App\Exceptions\DomainException(
                        'A read notification cannot be restored.'
                    );
                }

                return $notification->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore notification.', [
                'action' => self::class,
                'notification_id' => $notificationId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}