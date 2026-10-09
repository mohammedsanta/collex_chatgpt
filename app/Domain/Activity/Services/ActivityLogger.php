<?php

declare(strict_types=1);

namespace App\Domain\Activity\Services;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Http\Request;

final class ActivityLogger
{
    /** @param array<string, mixed> $properties */
    public function log(?int $userId, string $event, ?string $description = null, array $properties = [], ?object $subject = null, ?Request $request = null): ActivityLog
    {
        return ActivityLog::query()->create([
            'user_id' => $userId,
            'event' => $event,
            'description' => $description,
            'subject_type' => $subject !== null ? $subject::class : null,
            'subject_id' => $subject !== null && method_exists($subject, 'getKey') ? $subject->getKey() : null,
            'properties' => $properties,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'created_at' => now(),
        ]);
    }
}
