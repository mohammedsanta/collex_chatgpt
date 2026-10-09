<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Customers\Models\Client;
use App\Domain\Employees\Models\User;
use App\Domain\Payments\Models\Payment;
use App\Domain\Reports\Models\ActivityLog;
use App\Domain\Reports\Models\DailyCollectionReport;
use App\Domain\Reports\Models\ReportExport;
use App\Exceptions\DomainException;
use App\Notifications\ReportExportReadyNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class GenerateReportExport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;
    public int $timeout = 600;

    public function __construct(public readonly int $reportExportId) {}

    public function handle(): void
    {
        $export = ReportExport::query()->findOrFail($this->reportExportId);
        try {
            if (strtolower($export->format) !== 'csv') {
                throw new DomainException('Only CSV report exports are currently supported.', 'EXPORT_FORMAT_UNSUPPORTED');
            }
            $query = $this->buildQuery($export);
            $directory = 'exports';
            Storage::disk('local')->makeDirectory($directory);
            $filename = 'report-'.$export->getKey().'-'.now()->format('YmdHis').'.csv';
            $relativePath = $directory.'/'.$filename;
            $absolutePath = Storage::disk('local')->path($relativePath);
            $stream = fopen($absolutePath, 'wb');
            if ($stream === false) {
                throw new \RuntimeException('Unable to create export file.');
            }

            $rowCount = 0;
            try {
                $first = true;
                foreach ($query->cursor() as $row) {
                    $values = $row->toArray();
                    if ($first) {
                        fputcsv($stream, array_keys($values));
                        $first = false;
                    }
                    fputcsv($stream, array_map(fn ($value) => $this->safeCsvValue($value), array_values($values)));
                    $rowCount++;
                }
                if ($first) {
                    fputcsv($stream, ['No data']);
                }
            } finally {
                fclose($stream);
            }

            $export->update([
                'status' => 'completed', 'file_path' => $relativePath, 'row_count' => $rowCount,
                'error' => null, 'generated_at' => now(),
                'expires_at' => now()->addHours((int) config('collex.exports.expires_after_hours', 24)),
            ]);

            $user = User::query()->find($export->user_id);
            if ($user !== null) {
                $user->notify(new ReportExportReadyNotification($export->fresh()));
            }
        } catch (Throwable $exception) {
            $export->update(['status' => 'failed', 'error' => mb_substr($exception->getMessage(), 0, 5000), 'generated_at' => now()]);
            Log::error('Report export failed.', ['report_export_id' => $export->getKey(), 'exception' => $exception]);
            throw $exception;
        }
    }

    private function safeCsvValue(mixed $value): string
    {
        $text = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) : (string) ($value ?? '');
        if ($text !== '' && preg_match('/^[=+\-@\t\r]/', $text)) {
            return "'".$text;
        }
        return $text;
    }

    private function buildQuery(ReportExport $export): \Illuminate\Database\Eloquent\Builder
    {
        $filters = is_array($export->filters) ? $export->filters : [];
        return match ($export->type) {
            'clients' => Client::query()->select(['id','code','national_id','name','email','governorate_id','created_at'])
                ->when(isset($filters['governorate_id']), fn ($q) => $q->where('governorate_id', (int) $filters['governorate_id']))
                ->when(isset($filters['created_from']), fn ($q) => $q->whereDate('created_at', '>=', $filters['created_from']))
                ->when(isset($filters['created_to']), fn ($q) => $q->whereDate('created_at', '<=', $filters['created_to']))->orderBy('id'),
            'payments' => Payment::query()->select(['id','receipt_number','debt_case_id','collector_id','amount','method','reference','paid_at','status','confirmed_by','confirmed_at'])
                ->when(isset($filters['status']), fn ($q) => $q->where('status', $filters['status']))
                ->when(isset($filters['paid_from']), fn ($q) => $q->whereDate('paid_at', '>=', $filters['paid_from']))
                ->when(isset($filters['paid_to']), fn ($q) => $q->whereDate('paid_at', '<=', $filters['paid_to']))->orderBy('id'),
            'daily_collection_reports' => DailyCollectionReport::query()->select(['id','bank_id','user_id','report_date','cases_worked','calls_count','visits_count','promises_count','promised_amount','collected_amount','status'])
                ->when(isset($filters['bank_id']), fn ($q) => $q->where('bank_id', (int) $filters['bank_id']))
                ->when(isset($filters['date_from']), fn ($q) => $q->whereDate('report_date', '>=', $filters['date_from']))
                ->when(isset($filters['date_to']), fn ($q) => $q->whereDate('report_date', '<=', $filters['date_to']))->orderBy('id'),
            'activity_logs' => ActivityLog::query()->select(['id','user_id','event','description','subject_type','subject_id','ip_address','created_at'])
                ->when(isset($filters['event']), fn ($q) => $q->where('event', $filters['event']))
                ->when(isset($filters['created_from']), fn ($q) => $q->whereDate('created_at', '>=', $filters['created_from']))
                ->when(isset($filters['created_to']), fn ($q) => $q->whereDate('created_at', '<=', $filters['created_to']))->orderBy('id'),
            default => throw new DomainException('Unsupported report export type.', 'EXPORT_TYPE_UNSUPPORTED'),
        };
    }
}
