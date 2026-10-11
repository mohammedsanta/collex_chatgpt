<?php

declare(strict_types=1);

namespace App\Domain\Collections\Queries;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

final class GetPromisesToPay
{
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->baseQuery();

        $this->applyFilters($query, $filters);

        return $query
            ->orderByRaw(
                "CASE
                    WHEN promises_to_pay.status = 'active' THEN 0
                    ELSE 1
                END"
            )
            ->orderBy('promises_to_pay.promise_date')
            ->select([
                'promises_to_pay.id',
                'promises_to_pay.debt_case_id',
                'promises_to_pay.user_id',
                'promises_to_pay.promise_date',
                'promises_to_pay.promised_amount',
                'promises_to_pay.paid_amount',
                'promises_to_pay.status',
                'promises_to_pay.notes',
                'promises_to_pay.created_at',
                'debt_cases.loan_number',
                'clients.name as client_name',
                'clients.national_id',
                'users.name as collector_name',
                'banks.name as bank_name',
            ])
            ->paginate($perPage)
            ->withQueryString();
    }

    public function statistics(): array
    {
        $query = DB::table('promises_to_pay')
            ->whereNull('promises_to_pay.deleted_at');

        return [
            'total' => (clone $query)->count(),

            'active' => (clone $query)
                ->where('status', 'active')
                ->count(),

            'due_today' => (clone $query)
                ->where('status', 'active')
                ->whereDate('promise_date', today())
                ->count(),

            'overdue' => (clone $query)
                ->where('status', 'active')
                ->whereDate('promise_date', '<', today())
                ->count(),

            'promised_amount' => (clone $query)
                ->where('status', 'active')
                ->sum('promised_amount'),

            'paid_amount' => (clone $query)
                ->sum('paid_amount'),
        ];
    }

    private function baseQuery(): Builder
    {
        return DB::table('promises_to_pay')
            ->join(
                'debt_cases',
                'debt_cases.id',
                '=',
                'promises_to_pay.debt_case_id'
            )
            ->leftJoin(
                'clients',
                'clients.id',
                '=',
                'debt_cases.client_id'
            )
            ->leftJoin(
                'users',
                'users.id',
                '=',
                'promises_to_pay.user_id'
            )
            ->leftJoin(
                'banks',
                'banks.id',
                '=',
                'debt_cases.bank_id'
            )
            ->whereNull('promises_to_pay.deleted_at');
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        if (filled($filters['search'] ?? null)) {
            $search = trim((string) $filters['search']);

            $query->where(function (Builder $nested) use ($search): void {
                $nested
                    ->where('clients.name', 'like', "%{$search}%")
                    ->orWhere('clients.national_id', 'like', "%{$search}%")
                    ->orWhere('debt_cases.loan_number', 'like', "%{$search}%")
                    ->orWhere('users.name', 'like', "%{$search}%");
            });
        }

        if (filled($filters['status'] ?? null)) {
            $query->where(
                'promises_to_pay.status',
                $filters['status']
            );
        }

        if (filled($filters['date_from'] ?? null)) {
            $query->whereDate(
                'promises_to_pay.promise_date',
                '>=',
                $filters['date_from']
            );
        }

        if (filled($filters['date_to'] ?? null)) {
            $query->whereDate(
                'promises_to_pay.promise_date',
                '<=',
                $filters['date_to']
            );
        }
    }
}