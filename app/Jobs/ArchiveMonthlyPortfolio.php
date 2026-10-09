<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Loans\Models\Portfolio;
use App\Domain\Reports\Models\MonthlyArchive;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ArchiveMonthlyPortfolio implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function __construct(
        public readonly int $bankId,
        public readonly int $year,
        public readonly int $month,
        public readonly ?int $archivedBy = null,
    ) {}

    public function handle(): void
    {
        try {
            DB::transaction(function (): void {
                $portfolios = Portfolio::query()->where('bank_id', $this->bankId)
                    ->where('period_year', $this->year)->where('period_month', $this->month)
                    ->whereIn('status', ['active', 'archived'])->lockForUpdate()->get();
                if ($portfolios->isEmpty()) {
                    return;
                }

                $portfolioIds = $portfolios->modelKeys();
                $totals = DB::table('debt_cases')->whereIn('portfolio_id', $portfolioIds)->whereNull('deleted_at')
                    ->selectRaw('COUNT(*) as cases_count, COALESCE(SUM(total_debt),0) as total_debt, COALESCE(SUM(collected_amount),0) as collected_amount')->first();
                $now = now();
                MonthlyArchive::query()->updateOrCreate(
                    ['bank_id' => $this->bankId, 'year' => $this->year, 'month' => $this->month],
                    ['portfolio_id' => $portfolios->count() === 1 ? $portfolios->first()->getKey() : null,
                     'cases_count' => (int) ($totals->cases_count ?? 0),
                     'total_debt' => number_format((float) ($totals->total_debt ?? 0), 2, '.', ''),
                     'collected_amount' => number_format((float) ($totals->collected_amount ?? 0), 2, '.', ''),
                     'archived_by' => $this->archivedBy, 'archived_at' => $now,
                     'notes' => 'Automated monthly snapshot.'],
                );

                Portfolio::query()->whereIn('id', $portfolioIds)->update([
                    'status' => 'archived', 'archived_at' => $now, 'archived_by' => $this->archivedBy,
                ]);
            });
        } catch (Throwable $exception) {
            Log::error('Failed to archive monthly portfolio group.', ['bank_id' => $this->bankId, 'year' => $this->year, 'month' => $this->month, 'exception' => $exception]);
            throw $exception;
        }
    }
}
