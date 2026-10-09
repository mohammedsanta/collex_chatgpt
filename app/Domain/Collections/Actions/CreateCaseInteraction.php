<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateCaseInteraction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): CaseInteraction
    {
        try {
            return DB::transaction(function () use ($data): CaseInteraction {
                return CaseInteraction::create([
                    'debt_case_id' => $data['debt_case_id'],
                    'user_id' => $data['user_id'],
                    'client_phone_id' => $data['client_phone_id'] ?? null,
                    'type' => $data['type'],
                    'outcome' => $data['outcome'] ?? null,
                    'notes' => $data['notes'] ?? null,
                    'duration_seconds' => $data['duration_seconds'] ?? null,
                    'occurred_at' => $data['occurred_at'] ?? now(),
                    'followup_at' => $data['followup_at'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create case interaction.', [
                'action' => self::class,
                'debt_case_id' => $data['debt_case_id'] ?? null,
                'user_id' => $data['user_id'] ?? null,
                'type' => $data['type'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}