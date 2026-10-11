<?php

declare(strict_types=1);

namespace App\Domain\Reports\Jobs;

use App\Domain\Reports\Models\ReportExport;
use App\Domain\Reports\Services\ReportExportStorage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

final class GenerateReportExport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public int $timeout = 300;

    public function __construct(
        public readonly ReportExport $export,
    ) {
    }

    public function handle(
        ReportExportStorage $storage,
    ): void {
        $export = ReportExport::query()
            ->findOrFail($this->export->getKey());

        if ($export->status === 'completed') {
            return;
        }

        $export->forceFill([
            'status' => 'processing',
            'error' => null,
        ])->save();

        try {
            $result = $storage->generate($export);

            $export->forceFill([
                'status' => 'completed',
                'file_path' => $result['file_path'],
                'row_count' => $result['row_count'],
                'error' => null,
                'generated_at' => now(),
            ])->save();
        } catch (Throwable $exception) {
            Log::error('Failed to generate report export.', [
                'job' => self::class,
                'export_id' => $export->getKey(),
                'user_id' => $export->user_id,
                'exception' => $exception,
            ]);

            $export->forceFill([
                'status' => 'failed',
                'error' => mb_substr(
                    $exception->getMessage(),
                    0,
                    5000,
                ),
            ])->save();

            throw $exception;
        }
    }

    public function failed(?Throwable $exception): void
    {
        $export = ReportExport::query()
            ->find($this->export->getKey());

        if ($export === null) {
            return;
        }

        $export->forceFill([
            'status' => 'failed',
            'error' => mb_substr(
                $exception?->getMessage()
                    ?? 'Report export failed after all retry attempts.',
                0,
                5000,
            ),
        ])->save();

        Log::error('Report export job exhausted its retries.', [
            'job' => self::class,
            'export_id' => $export->getKey(),
            'exception' => $exception,
        ]);
    }
}