<?php

declare(strict_types=1);

namespace App\Domain\Payments\Queries;

use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

final class GetPaymentsConfirmedByUser
{
    public function execute(int $userId): Builder
    {
        return Payment::query()
            ->where('confirmed_by', $userId)
            ->with(['debtCase.client', 'collector', 'confirmedBy'])
            ->latest('confirmed_at');
    }
}