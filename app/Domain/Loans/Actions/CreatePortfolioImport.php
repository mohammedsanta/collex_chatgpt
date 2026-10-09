<?php

declare(strict_types=1);

namespace App\Domain\Loans\Actions;

use App\Domain\Loans\Models\Portfolio;
use App\Domain\Loans\Models\PortfolioImport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Throwable;

final class CreatePortfolioImport
{
    /** @param array<string, mixed> $data */
    public function execute(array $data, ?int $importedBy = null): PortfolioImport
    {
        $file = $data['file'] ?? null;
        if (! $file instanceof UploadedFile) {
            throw new InvalidArgumentException('A CSV file upload is required.');
        }

        $storedPath = $file->store('imports', 'local');
        if (! is_string($storedPath) || $storedPath === '') {
            throw new InvalidArgumentException('The uploaded file could not be stored.');
        }

        try {
            return DB::transaction(function () use ($data, $importedBy, $file, $storedPath): PortfolioImport {
                $portfolio = Portfolio::query()->lockForUpdate()->findOrFail($data['portfolio_id']);
                if ($portfolio->status !== 'draft') {
                    throw new \App\Exceptions\DomainException('Imports can only be attached to draft portfolios.', 'PORTFOLIO_NOT_DRAFT');
                }

                return PortfolioImport::query()->create([
                    'portfolio_id' => $portfolio->getKey(),
                    'imported_by' => $importedBy,
                    'original_filename' => basename($file->getClientOriginalName()),
                    'stored_path' => $storedPath,
                    'status' => 'pending',
                    'total_rows' => 0,
                    'success_rows' => 0,
                    'failed_rows' => 0,
                ]);
            });
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($storedPath);
            Log::error('Failed to create portfolio import.', ['portfolio_id' => $data['portfolio_id'] ?? null, 'exception' => $exception]);
            throw $exception;
        }
    }
}
