<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateVisit
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): Visit
    {
        try {
            return DB::transaction(function () use ($data): Visit {
                return Visit::create([
                    'debt_case_id' => $data['debt_case_id'],
                    'user_id' => $data['user_id'],
                    'assigned_by' => $data['assigned_by'] ?? null,
                    'status' => 'scheduled',
                    'scheduled_at' => $data['scheduled_at'],
                    'visited_at' => null,
                    'address' => $data['address'] ?? null,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                    'outcome' => null,
                    'notes' => $data['notes'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create visit.', [
                'action' => self::class,
                'debt_case_id' => $data['debt_case_id'] ?? null,
                'user_id' => $data['user_id'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}