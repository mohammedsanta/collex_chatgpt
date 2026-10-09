<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class DeleteCaseInteraction
{
    public function execute(CaseInteraction $interaction): void
    {
        try {
            DB::transaction(function () use ($interaction): void {
                $interaction = CaseInteraction::query()
                    ->lockForUpdate()
                    ->findOrFail($interaction->getKey());

                $interaction->delete();
            });
        } catch (Throwable $e) {
            Log::error('Failed to delete case interaction.', [
                'action' => self::class,
                'interaction_id' => $interaction->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}