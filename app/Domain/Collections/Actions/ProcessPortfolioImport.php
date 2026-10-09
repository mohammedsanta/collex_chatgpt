<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PortfolioImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ProcessPortfolioImport
{
    public function execute(PortfolioImport $import): PortfolioImport
    {
        try {
            return DB::transaction(function () use ($import): PortfolioImport {
                $import = PortfolioImport::query()
                    ->lockForUpdate()
                    ->findOrFail($import->getKey());

                if ($import->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only pending portfolio imports can be processed.'
                    );
                }

                $import->update([
                    'status' => 'processing',
                    'started_at' => now(),
                    'finished_at' => null,
                    'errors' => null,
                ]);

                return $import->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to start portfolio import.', [
                'action' => self::class,
                'portfolio_import_id' => $import->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}