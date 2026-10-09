<?php

declare(strict_types=1);

namespace App\Domain\Collections\Actions;

use App\Domain\Collections\Models\PortfolioImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CompletePortfolioImport
{
    public function execute(PortfolioImport $import): PortfolioImport
    {
        try {
            return DB::transaction(function () use ($import): PortfolioImport {
                $import = PortfolioImport::query()
                    ->lockForUpdate()
                    ->findOrFail($import->getKey());

                if ($import->status !== 'processing') {
                    throw new \App\Exceptions\DomainException(
                        'Only processing imports can be completed.'
                    );
                }

                $import->update([
                    'status' => 'completed',
                    'finished_at' => now(),
                ]);

                return $import->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to complete portfolio import.', [
                'action' => self::class,
                'portfolio_import_id' => $import->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}