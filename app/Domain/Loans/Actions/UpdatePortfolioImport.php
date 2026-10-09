<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdatePortfolioImport
{
    public function execute(
        PortfolioImport $import,
        array $data
    ): PortfolioImport {
        try {
            return DB::transaction(function () use ($import, $data): PortfolioImport {
                $import = PortfolioImport::query()
                    ->lockForUpdate()
                    ->findOrFail($import->getKey());

                if (in_array($import->status, ['processing', 'completed'], true)) {
                    throw new \App\Exceptions\DomainException(
                        'A processing or completed portfolio import cannot be updated.'
                    );
                }

                $import->update($data);

                return $import->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update portfolio import.', [
                'action' => self::class,
                'portfolio_import_id' => $import->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}