<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Actions;

use App\Domain\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateNotification
{
    public function execute(
        Model $notifiable,
        string $type,
        array $data
    ): Notification {
        try {
            return DB::transaction(function () use (
                $notifiable,
                $type,
                $data
            ): Notification {
                return Notification::query()->create([
                    'id' => (string) str()->uuid(),
                    'type' => $type,
                    'notifiable_type' => $notifiable->getMorphClass(),
                    'notifiable_id' => $notifiable->getKey(),
                    'data' => json_encode(
                        $data,
                        JSON_THROW_ON_ERROR
                    ),
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create notification.', [
                'action' => self::class,
                'notifiable_type' => $notifiable->getMorphClass(),
                'notifiable_id' => $notifiable->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}