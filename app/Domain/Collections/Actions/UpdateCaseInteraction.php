<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateCaseInteraction
{
    public function execute(
        CaseInteraction $interaction,
        array $data
    ): CaseInteraction {
        try {
            return DB::transaction(function () use (
                $interaction,
                $data
            ): CaseInteraction {
                $interaction = CaseInteraction::query()
                    ->lockForUpdate()
                    ->findOrFail($interaction->getKey());

                $interaction->update([
                    'client_phone_id' => $data['client_phone_id']
                        ?? $interaction->client_phone_id,
                    'type' => $data['type']
                        ?? $interaction->type,
                    'outcome' => $data['outcome']
                        ?? $interaction->outcome,
                    'notes' => $data['notes']
                        ?? $interaction->notes,
                    'duration_seconds' => $data['duration_seconds']
                        ?? $interaction->duration_seconds,
                    'occurred_at' => $data['occurred_at']
                        ?? $interaction->occurred_at,
                    'followup_at' => $data['followup_at']
                        ?? $interaction->followup_at,
                ]);

                return $interaction->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update case interaction.', [
                'action' => self::class,
                'interaction_id' => $interaction->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}