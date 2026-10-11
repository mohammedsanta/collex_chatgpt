<?php

namespace App\Domain\Dashboard\Queries;

use App\Domain\Customers\Models\Client;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

final class GetDashboardOverview
{
    public function handle(): array
    {
        $today = CarbonImmutable::today();
        $monthStart = $today->startOfMonth();
        $sixMonthStart = $monthStart->subMonths(5);
        $sixMonthEnd = $monthStart->addMonth()->subSecond();

        $activeCases = DebtCase::query()
            ->where('status', 'active');

        $overdueCases = DebtCase::query()
            ->where('status', 'overdue');

        $confirmedPayments = Payment::query()
            ->where('status', 'confirmed');

        $stats = [
            'clients' => Client::query()->count(),

            'active_cases' => (clone $activeCases)->count(),

            'total_debt' => (float) (clone $activeCases)
                ->sum('total_debt'),

            'overdue_cases' => (clone $overdueCases)->count(),

            'overdue_amount' => (float) (clone $overdueCases)
                ->sum('overdue_amount'),

            'confirmed_today' => (float) (clone $confirmedPayments)
                ->whereDate('paid_at', $today)
                ->sum('amount'),

            'confirmed_this_month' => (float) (clone $confirmedPayments)
                ->whereBetween('paid_at', [$monthStart, $sixMonthEnd])
                ->sum('amount'),

            'confirmed_total' => (float) (clone $confirmedPayments)
                ->sum('amount'),

            'pending_payments' => Payment::query()
                ->where('status', 'pending')
                ->count(),
        ];

        $monthlyCollections = $this->getMonthlyCollections(
            $sixMonthStart,
            $sixMonthEnd,
        );

        $maxMonthlyCollection = max(
            1,
            (float) $monthlyCollections->max('amount'),
        );

        $recentPayments = Payment::query()
            ->with([
                'debtCase.client',
                'collector',
            ])
            ->latest('created_at')
            ->limit(8)
            ->get();

        return [
            'stats' => $stats,
            'monthlyCollections' => $monthlyCollections,
            'maxMonthlyCollection' => $maxMonthlyCollection,
            'recentPayments' => $recentPayments,
        ];
    }

    private function getMonthlyCollections(
        CarbonImmutable $start,
        CarbonImmutable $end,
    ): Collection {
        $totals = Payment::query()
            ->where('status', 'confirmed')
            ->whereBetween('paid_at', [$start, $end])
            ->selectRaw(
                'YEAR(paid_at) as year, MONTH(paid_at) as month, SUM(amount) as amount'
            )
            ->groupByRaw('YEAR(paid_at), MONTH(paid_at)')
            ->get()
            ->keyBy(
                fn ($row) => sprintf('%04d-%02d', $row->year, $row->month)
            );

        $months = collect();

        for ($date = $start->startOfMonth(); $date <= $end; $date = $date->addMonth()) {
            $key = $date->format('Y-m');
            $row = $totals->get($key);

            $months->push([
                'label' => $date->locale('ar')->translatedFormat('M'),
                'year' => $date->format('Y'),
                'amount' => (float) ($row->amount ?? 0),
            ]);
        }

        return $months;
    }
}
