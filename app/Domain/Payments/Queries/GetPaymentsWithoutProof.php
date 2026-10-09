<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsWithoutProof
{
    public function execute(): Builder
    {
        return Payment::query()
            ->whereNull('proof_path')
            ->with([
                'debtCase.client',
                'collector',
            ])
            ->latest('paid_at');
    }
}