<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Reports\Models\PerformanceSnapshot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

final class GeneratePerformanceSnapshot implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public function __construct(public readonly int $userId, public readonly int $bankId, public readonly int $year, public readonly int $month) {}

    public function handle(): void
    {
        $start = sprintf('%04d-%02d-01', $this->year, $this->month);
        $end = date('Y-m-t', strtotime($start));
        $assigned = DB::table('case_assignments')->join('debt_cases', 'debt_cases.id', '=', 'case_assignments.debt_case_id')
            ->where('case_assignments.user_id', $this->userId)->where('debt_cases.bank_id', $this->bankId)
            ->whereDate('case_assignments.assigned_at', '<=', $end)
            ->where(fn ($q) => $q->whereNull('case_assignments.unassigned_at')->orWhereDate('case_assignments.unassigned_at', '>=', $start))
            ->distinct('case_assignments.debt_case_id')->count('case_assignments.debt_case_id');
        $processed = DB::table('case_interactions')->join('debt_cases', 'debt_cases.id', '=', 'case_interactions.debt_case_id')
            ->where('case_interactions.user_id', $this->userId)->where('debt_cases.bank_id', $this->bankId)
            ->whereBetween('case_interactions.occurred_at', [$start.' 00:00:00', $end.' 23:59:59'])->distinct('case_interactions.debt_case_id')->count('case_interactions.debt_case_id');
        $promises = DB::table('promises_to_pay')->join('debt_cases', 'debt_cases.id', '=', 'promises_to_pay.debt_case_id')
            ->where('promises_to_pay.user_id', $this->userId)->where('debt_cases.bank_id', $this->bankId)
            ->whereBetween('promises_to_pay.created_at', [$start.' 00:00:00', $end.' 23:59:59'])->whereNull('promises_to_pay.deleted_at');
        $promiseTotal = (clone $promises)->count();
        $kept = (clone $promises)->where('promises_to_pay.status', 'kept')->count();
        $broken = (clone $promises)->where('promises_to_pay.status', 'broken')->count();
        $collected = DB::table('payments')->join('debt_cases', 'debt_cases.id', '=', 'payments.debt_case_id')
            ->where('payments.collector_id', $this->userId)->where('debt_cases.bank_id', $this->bankId)
            ->where('payments.status', 'confirmed')->whereNull('payments.deleted_at')
            ->whereBetween('payments.paid_at', [$start.' 00:00:00', $end.' 23:59:59'])->sum('payments.amount');

        PerformanceSnapshot::query()->updateOrCreate(
            ['user_id'=>$this->userId,'bank_id'=>$this->bankId,'year'=>$this->year,'month'=>$this->month],
            ['cases_assigned'=>$assigned,'cases_processed'=>$processed,'promises_total'=>$promiseTotal,'promises_kept'=>$kept,'promises_broken'=>$broken,'collected_amount'=>number_format((float)$collected,2,'.',''),'target_amount'=>'0.00','efficiency'=>'0.00','rank_position'=>null,'calculated_at'=>now()],
        );
    }
}
