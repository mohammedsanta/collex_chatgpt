<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ExpireReportExports
{
    public function execute(): int
    {
        try {
            return DB::transaction(function (): int {
                return ReportExport::query()
                    ->where('status', 'completed')
                    ->whereNotNull('expires_at')
                    ->where('expires_at', '<=', now())
                    ->update([
                        'status' => 'failed',
                        'error' => 'Export file expired.',
                    ]);
            });
        } catch (Throwable $e) {
            Log::error('Failed to expire report exports.', [
                'action' => self::class,
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}