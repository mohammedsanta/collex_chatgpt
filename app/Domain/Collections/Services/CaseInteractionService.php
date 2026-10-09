<?php

declare(strict_types=1);

namespace App\Domain\Collections\Services;

use App\Domain\Collections\Models\CaseInteraction;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CaseInteractionService
{
    public function requiresFollowUp(CaseInteraction $interaction): bool
    {
        return filled($interaction->followup_at);
    }

    public function isSuccessful(CaseInteraction $interaction): bool
    {
        return in_array(
            $interaction->outcome,
            ['answered', 'promised', 'paid'],
            true
        );
    }
}