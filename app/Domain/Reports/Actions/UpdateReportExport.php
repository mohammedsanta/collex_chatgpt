<?php

declare(strict_types=1);

namespace App\Domain\Reports\Actions;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class UpdateReportExport
{
    public function execute(
        ReportExport $export,
        array $data
    ): ReportExport {
        try {
            return DB::transaction(function () use ($export, $data): ReportExport {
                $export = ReportExport::query()
                    ->lockForUpdate()
                    ->findOrFail($export->getKey());

                if ($export->status !== 'pending') {
                    throw new \App\Exceptions\DomainException(
                        'Only a pending report export can be updated.'
                    );
                }

                $export->update($data);

                return $export->refresh();
            });
        } catch (Throwable $e) {
            Log::error('Failed to update report export.', [
                'action' => self::class,
                'report_export_id' => $export->getKey(),
                'exception' => $e,
            ]);

            throw $e;
        }
    }
}