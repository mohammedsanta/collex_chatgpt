<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Foundation\Http\FormRequest;

final class CreateDailyCollectionReportRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('create', DailyCollectionReport::class) ?? false; }
    public function rules(): array
    {
        return ['bank_id'=>['required','integer','exists:banks,id'],'report_date'=>['required','date'],'cases_worked'=>['required','integer','min:0'],'calls_count'=>['required','integer','min:0'],'visits_count'=>['required','integer','min:0'],'promises_count'=>['required','integer','min:0'],'promised_amount'=>['required','numeric','min:0','decimal:0,2'],'collected_amount'=>['required','numeric','min:0','decimal:0,2'],'notes'=>['nullable','string','max:5000']];
    }
}
