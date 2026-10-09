<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\DebtCase;
use App\Jobs\GeneratePerformanceSnapshot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class GeneratePerformanceSnapshots extends Command
{
    protected $signature = 'collex:generate-performance-snapshots {--year=} {--month=}';
    protected $description = 'Queue monthly performance snapshots for assigned bank users.';

    public function handle(): int
    {
        $default = now()->subMonthNoOverflow();
        $year = (int) ($this->option('year') ?: $default->year);
        $month = (int) ($this->option('month') ?: $default->month);
        if ($year < 2000 || $year > 2200 || $month < 1 || $month > 12) {
            $this->error('Invalid year/month.');
            return self::INVALID;
        }

        $assignments = DB::table('bank_user')->select('bank_id', 'user_id')->distinct()->get();
        $keys = $assignments->map(fn ($row) => $row->bank_id.':'.$row->user_id);
        $caseAssignments = DebtCase::query()->whereNotNull('assigned_user_id')->select('bank_id', 'assigned_user_id')->distinct()->get();
        $keys = $keys->merge($caseAssignments->map(fn ($row) => $row->bank_id.':'.$row->assigned_user_id))->unique();
        foreach ($keys as $key) {
            [$bankId, $userId] = array_map('intval', explode(':', (string) $key, 2));
            GeneratePerformanceSnapshot::dispatch($userId, $bankId, $year, $month);
        }
        $this->info("Queued {$keys->count()} performance snapshot(s) for {$year}-".str_pad((string) $month, 2, '0', STR_PAD_LEFT).'.');
        return self::SUCCESS;
    }
}
