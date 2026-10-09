<?php

declare(strict_types=1);

namespace App\Domain\Customers\Services;

use App\Domain\Customers\Models\Client;

final class ClientDebtSummaryService
{
    public function summarize(Client $client): array
    {
        $cases = $client->debtCases();

        return [
            'cases_count' => (clone $cases)->count(),
            'total_debt' => (float) (clone $cases)->sum('total_debt'),
            'overdue_amount' => (float) (clone $cases)->sum('overdue_amount'),
            'collected_amount' => (float) (clone $cases)->sum('collected_amount'),
            'remaining_amount' => (float) (clone $cases)
                ->selectRaw(
                    'COALESCE(SUM(total_debt - collected_amount), 0) as total'
                )
                ->value('total'),
        ];
    }
}