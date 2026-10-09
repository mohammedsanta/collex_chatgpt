<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

final class GenerateDailyCollectionReports implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function __construct(public readonly string $reportDate) {}

    public function handle(): void
    {
        $interactions = DB::table('case_interactions')
            ->join('debt_cases', 'debt_cases.id', '=', 'case_interactions.debt_case_id')
            ->whereDate('case_interactions.occurred_at', $this->reportDate)
            ->selectRaw('debt_cases.bank_id, case_interactions.user_id, COUNT(DISTINCT case_interactions.debt_case_id) as cases_worked, SUM(CASE WHEN case_interactions.type = ? THEN 1 ELSE 0 END) as calls_count, SUM(CASE WHEN case_interactions.type = ? THEN 1 ELSE 0 END) as visits_count', ['call', 'visit'])
            ->groupBy('debt_cases.bank_id', 'case_interactions.user_id')
            ->get()->keyBy(fn ($row) => $row->bank_id.':'.$row->user_id);

        $promises = DB::table('promises_to_pay')
            ->join('debt_cases', 'debt_cases.id', '=', 'promises_to_pay.debt_case_id')
            ->whereDate('promises_to_pay.created_at', $this->reportDate)
            ->whereNull('promises_to_pay.deleted_at')
            ->selectRaw('debt_cases.bank_id, promises_to_pay.user_id, COUNT(*) as promises_count, SUM(promises_to_pay.promised_amount) as promised_amount')
            ->groupBy('debt_cases.bank_id', 'promises_to_pay.user_id')
            ->get()->keyBy(fn ($row) => $row->bank_id.':'.$row->user_id);

        $payments = DB::table('payments')
            ->join('debt_cases', 'debt_cases.id', '=', 'payments.debt_case_id')
            ->whereDate('payments.paid_at', $this->reportDate)
            ->where('payments.status', 'confirmed')->whereNull('payments.deleted_at')
            ->selectRaw('debt_cases.bank_id, payments.collector_id as user_id, SUM(payments.amount) as collected_amount')
            ->whereNotNull('payments.collector_id')
            ->groupBy('debt_cases.bank_id', 'payments.collector_id')
            ->get()->keyBy(fn ($row) => $row->bank_id.':'.$row->user_id);

        $keys = $interactions->keys()->merge($promises->keys())->merge($payments->keys())->unique();
        foreach ($keys as $key) {
            [$bankId, $userId] = array_map('intval', explode(':', (string) $key, 2));
            $interaction = $interactions->get($key);
            $promise = $promises->get($key);
            $payment = $payments->get($key);
            DB::transaction(function () use ($bankId, $userId, $interaction, $promise, $payment): void {
                $report = DailyCollectionReport::query()->lockForUpdate()->firstOrNew([
                    'bank_id' => $bankId, 'user_id' => $userId, 'report_date' => $this->reportDate,
                ]);
                if ($report->exists && $report->status !== 'draft') {
                    return; // Never overwrite a submitted/approved report during a regeneration.
                }
                $report->fill([
                    'cases_worked' => (int) ($interaction->cases_worked ?? 0),
                    'calls_count' => (int) ($interaction->calls_count ?? 0),
                    'visits_count' => (int) ($interaction->visits_count ?? 0),
                    'promises_count' => (int) ($promise->promises_count ?? 0),
                    'promised_amount' => number_format((float) ($promise->promised_amount ?? 0), 2, '.', ''),
                    'collected_amount' => number_format((float) ($payment->collected_amount ?? 0), 2, '.', ''),
                    'status' => 'draft',
                ])->save();
            });
        }
    }
}
