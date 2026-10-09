<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\Loans\Models\Portfolio;
use App\Jobs\ArchiveMonthlyPortfolio;
use Illuminate\Console\Command;

final class ArchiveMonthlyPortfolios extends Command
{
    protected $signature = 'collex:archive-monthly-portfolios {--year=} {--month=} {--bank-id=} {--actor-id=}';
    protected $description = 'Queue portfolio archival and monthly bank snapshots.';

    public function handle(): int
    {
        $default = now()->subMonthNoOverflow();
        $year = (int) ($this->option('year') ?: $default->year);
        $month = (int) ($this->option('month') ?: $default->month);
        $actorId = $this->option('actor-id') !== null ? (int) $this->option('actor-id') : null;
        if ($year < 2000 || $year > 2200 || $month < 1 || $month > 12) {
            $this->error('Invalid year/month.');
            return self::INVALID;
        }
        $query = Portfolio::query()->where('period_year', $year)->where('period_month', $month)->whereIn('status', ['active','archived']);
        if ($this->option('bank-id')) { $query->where('bank_id', (int) $this->option('bank-id')); }
        $bankIds = $query->distinct()->pluck('bank_id');
        foreach ($bankIds as $bankId) { ArchiveMonthlyPortfolio::dispatch((int) $bankId, $year, $month, $actorId); }
        $this->info("Queued {$bankIds->count()} bank archive job(s).");
        return self::SUCCESS;
    }
}
