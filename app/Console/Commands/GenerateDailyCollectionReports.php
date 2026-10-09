<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\GenerateDailyCollectionReports as GenerateDailyCollectionReportsJob;
use Illuminate\Console\Command;

final class GenerateDailyCollectionReports extends Command
{
    protected $signature = 'collex:generate-daily-collection-reports {date? : Report date in YYYY-MM-DD format}';
    protected $description = 'Queue daily collection report generation.';

    public function handle(): int
    {
        $date = (string) ($this->argument('date') ?: now()->subDay()->toDateString());
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) || ! strtotime($date)) {
            $this->error('Date must use YYYY-MM-DD format.');
            return self::INVALID;
        }
        GenerateDailyCollectionReportsJob::dispatch($date);
        $this->info("Daily report generation queued for {$date}.");
        return self::SUCCESS;
    }
}
