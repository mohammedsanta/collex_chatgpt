<?php

namespace App\Domain\Reports\Queries;

use App\Domain\Customers\Models\Client;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Collection;

final class GetDashboardStatistics
{
    /**
     * Retrieve the data required by the dashboard.
     *
     * @return array{
     *     stats: array<string, int|float>,
     *     recentPayments: Collection,
     *     monthlyCollections: Collection,
     *     maxMonthlyCollection: float
     * }
     */
    public function execute(): array
    {
        $today = now()->toDateString();
        $monthStart = now()->copy()->startOfMonth();
        $monthEnd = now()->copy()->endOfMonth();

        $activeCases = DebtCase::query()
            ->where('status', 'active');

        $confirmedPayments = Payment::query()
            ->where('status', 'confirmed');

        $stats = [
            'clients' => Client::query()->count(),

            'active_cases' => (clone $activeCases)->count(),

            'total_debt' => (float) (clone $activeCases)
                ->sum('total_debt'),

            'overdue_amount' => (float) (clone $activeCases)
                ->sum('overdue_amount'),

            'overdue_cases' => (clone $activeCases)
                ->where('dpd', '>', 0)
                ->where('overdue_amount', '>', 0)
                ->count(),

            'pending_payments' => Payment::query()
                ->where('status', 'pending')
                ->count(),

            'confirmed_today' => (float) (clone $confirmedPayments)
                ->whereDate('confirmed_at', $today)
                ->sum('amount'),

            'confirmed_this_month' => (float) (clone $confirmedPayments)
                ->whereBetween('confirmed_at', [
                    $monthStart,
                    $monthEnd,
                ])
                ->sum('amount'),

            'confirmed_total' => (float) (clone $confirmedPayments)
                ->sum('amount'),
        ];

        $recentPayments = Payment::query()
            ->with([
                'debtCase.client',
                'collector',
            ])
            ->latest('created_at')
            ->limit(8)
            ->get();

        $monthlyCollections = collect(range(5, 0))
            ->map(function (int $monthsAgo): array {
                $month = now()
                    ->copy()
                    ->startOfMonth()
                    ->subMonths($monthsAgo);

                $amount = Payment::query()
                    ->where('status', 'confirmed')
                    ->whereBetween('confirmed_at', [
                        $month->copy()->startOfMonth(),
                        $month->copy()->endOfMonth(),
                    ])
                    ->sum('amount');

                return [
                    'label' => $month->translatedFormat('M'),
                    'year' => $month->format('Y'),
                    'amount' => (float) $amount,
                ];
            })
            ->values();

        $maxMonthlyCollection = max(
            1.0,
            (float) $monthlyCollections->max('amount')
        );

        return [
            'stats' => $stats,
            'recentPayments' => $recentPayments,
            'monthlyCollections' => $monthlyCollections,
            'maxMonthlyCollection' => $maxMonthlyCollection,
        ];
    }
}