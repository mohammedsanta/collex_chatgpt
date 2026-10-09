<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CreateReportExport
{
    public function execute(array $data): ReportExport
    {
        try {
            return DB::transaction(function () use ($data): ReportExport {
                return ReportExport::create([
                    'user_id' => $data['user_id'],
                    'type' => $data['type'],
                    'format' => $data['format'],
                    'filters' => $data['filters'] ?? null,
                    'status' => 'pending',
                    'file_path' => null,
                    'row_count' => null,
                    'error' => null,
                    'generated_at' => null,
                    'expires_at' => $data['expires_at'] ?? null,
                ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to create report export.', [
                'action' => self::class,
                'user_id' => $data['user_id'] ?? null,
                'type' => $data['type'] ?? null,
                'format' => $data['format'] ?? null,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}