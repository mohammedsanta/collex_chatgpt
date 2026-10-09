<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\MarkMissedVisits as MarkMissedVisitsJob;
use Illuminate\Console\Command;

final class MarkMissedVisits extends Command
{
    protected $signature = 'collex:mark-missed-visits';
    protected $description = 'Queue marking overdue scheduled visits as missed.';

    public function handle(): int
    {
        MarkMissedVisitsJob::dispatch();
        $this->info('Missed visit evaluation queued.');
        return self::SUCCESS;
    }
}
