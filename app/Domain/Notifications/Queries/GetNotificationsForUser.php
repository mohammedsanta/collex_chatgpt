<?php

declare(strict_types=1);

namespace App\Domain\Notifications\Queries;

use App\Domain\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Builder;

final class GetNotificationsForUser
{
    public function execute(int $userId): Builder
    {
        return Notification::query()
            ->where('notifiable_type', 'App\\Domain\\Employees\\Models\\User')
            ->where('notifiable_id', $userId)
            ->latest();
    }
}