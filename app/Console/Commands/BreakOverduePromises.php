<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\BreakOverduePromises as BreakOverduePromisesJob;
use Illuminate\Console\Command;

final class BreakOverduePromises extends Command
{
    protected $signature = 'collex:break-overdue-promises';
    protected $description = 'Queue evaluation of overdue promises to pay.';

    public function handle(): int
    {
        BreakOverduePromisesJob::dispatch();
        $this->info('Overdue promise evaluation queued.');
        return self::SUCCESS;
    }
}
