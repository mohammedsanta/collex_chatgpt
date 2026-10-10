<?php

declare(strict_types=1);

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Client;
use Illuminate\Support\Collection;

final class GetClientDetails
{
    public function execute(Client $client): array
    {
        $client->load([
            'governorate',
            'phones',
            'debtCases.bank',
            'debtCases.portfolio',
            'debtCases.loanType',
            'debtCases.assignedUser',
            'debtCases.promisesToPay',
            'debtCases.payments.collector',
            'debtCases.visits.user',
            'debtCases.complaints',
            'debtCases.interactions',
        ]);

        $cases = $client->debtCases;

        $promises = $cases
            ->flatMap(fn ($case) => $case->promisesToPay)
            ->sortByDesc('promise_date')
            ->values();

        $payments = $cases
            ->flatMap(fn ($case) => $case->payments)
            ->sortByDesc('paid_at')
            ->values();

        $visits = $cases
            ->flatMap(fn ($case) => $case->visits)
            ->sortByDesc('scheduled_at')
            ->values();

        $complaints = $cases
            ->flatMap(fn ($case) => $case->complaints)
            ->sortByDesc('created_at')
            ->values();

        $interactions = $cases
            ->flatMap(fn ($case) => $case->interactions)
            ->sortByDesc('created_at')
            ->values();

        $totalDebt = (float) $cases->sum('total_debt');
        $totalCollected = (float) $cases->sum('collected_amount');
        $totalOverdue = (float) $cases->sum('overdue_amount');

        return [
            'client' => $client,
            'debtCases' => $cases,
            'promises' => $promises,
            'payments' => $payments,
            'visits' => $visits,
            'complaints' => $complaints,
            'interactions' => $interactions,

            'collectionSummary' => [
                'cases_count' => $cases->count(),
                'total_debt' => $totalDebt,
                'total_collected' => $totalCollected,
                'remaining' => max(0, $totalDebt - $totalCollected),
                'total_overdue' => $totalOverdue,
                'promises_count' => $promises->count(),
                'payments_count' => $payments->count(),
                'visits_count' => $visits->count(),
                'complaints_count' => $complaints->count(),
            ],

            // No guarantor model/relation has been provided yet.
            'guarantor' => null,
        ];
    }
}
