<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RestoreCaseInteraction
{
    public function execute(int $interactionId): CaseInteraction
    {
        try {
            return DB::transaction(function () use ($interactionId): CaseInteraction {
                $interaction = CaseInteraction::withTrashed()
                    ->lockForUpdate()
                    ->findOrFail($interactionId);

                if (! $interaction->trashed()) {
                    throw new \App\Exceptions\DomainException(
                        'The case interaction is not deleted.'
                    );
                }

                $interaction->restore();

                return $interaction->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to restore case interaction.', [
                'action' => self::class,
                'interaction_id' => $interactionId,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}