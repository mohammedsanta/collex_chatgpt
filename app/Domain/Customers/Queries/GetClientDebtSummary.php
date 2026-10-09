<?php

declare(strict_types=1);

namespace App\Domain\Customers\Queries;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class GetClientDebtSummary
{
    public function execute(int $clientId): Builder
    {
        return Client::query()
            ->whereKey($clientId)
            ->with([
                'phones',
                'governorate',
                'debtCases' => function ($query): void {
                    $query
                        ->select([
                            'id',
                            'client_id',
                            'status',
                            'total_debt',
                            'overdue_amount',
                            'collected_amount',
                            'installment_value',
                            'dpd',
                            'next_due_date',
                        ])
                        ->withSum(
                            'payments',
                            'amount'
                        );
                },
            ]);
    }
}