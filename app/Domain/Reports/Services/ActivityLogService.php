<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ActivityLogService
{
    public function record(
        ?int $userId,
        string $event,
        ?string $description = null,
        ?Model $subject = null,
        array $properties = [],
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): ActivityLog {
        try {
            return ActivityLog::query()->create([
                'user_id' => $userId,
                'event' => $event,
                'description' => $description,
                'subject_type' => $subject?->getMorphClass(),
                'subject_id' => $subject?->getKey(),
                'properties' => $properties,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to create activity log.', [
                'event' => $event,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}