<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\PortfolioImport;
use App\Jobs\ProcessPortfolioImport as ProcessPortfolioImportJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ProcessPortfolioImport
{
    public function execute(PortfolioImport $import): PortfolioImport
    {
        try {
            return DB::transaction(function () use ($import): PortfolioImport {
                $locked = PortfolioImport::query()->lockForUpdate()->findOrFail($import->getKey());
                if (! in_array($locked->status, ['pending', 'failed'], true)) {
                    throw new \App\Exceptions\DomainException('Only pending or failed imports can be processed.', 'IMPORT_NOT_PROCESSABLE');
                }
                $locked->update(['status' => 'processing', 'started_at' => now(), 'finished_at' => null, 'errors' => null]);
                ProcessPortfolioImportJob::dispatch($locked->getKey())->afterCommit();
                return $locked->refresh();
            });
        } catch (Throwable $exception) {
            Log::error('Failed to queue portfolio import.', ['portfolio_import_id' => $import->getKey(), 'exception' => $exception]);
            throw $exception;
        }
    }
}
