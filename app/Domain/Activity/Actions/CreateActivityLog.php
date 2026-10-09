<?php

declare(strict_types=1);

namespace App\Domain\Activity\Actions;

use App\Domain\Activity\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateActivityLog
{
    public function execute(
        ?int $userId,
        string $event,
        ?string $description = null,
        ?Model $subject = null,
        array $properties = [],
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): ActivityLog {
        try {
            return DB::transaction(function () use (
                $userId,
                $event,
                $description,
                $subject,
                $properties,
                $ipAddress,
                $userAgent
            ): ActivityLog {
                return ActivityLog::create([
                    'user_id' => $userId,
                    'event' => $event,
                    'description' => $description,
                    'subject_type' => $subject?->getMorphClass(),
                    'subject_id' => $subject?->getKey(),
                    'properties' => $properties,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create activity log.', [
                'action' => self::class,
                'user_id' => $userId,
                'event' => $event,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}