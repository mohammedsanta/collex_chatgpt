<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use App\Domain\Reports\Models\DailyCollectionReport;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateDailyCollectionReportRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('update', $this->route('report')) ?? false; }
    public function rules(): array
    {
        return ['cases_worked'=>['sometimes','required','integer','min:0'],'calls_count'=>['sometimes','required','integer','min:0'],'visits_count'=>['sometimes','required','integer','min:0'],'promises_count'=>['sometimes','required','integer','min:0'],'promised_amount'=>['sometimes','required','numeric','min:0','decimal:0,2'],'collected_amount'=>['sometimes','required','numeric','min:0','decimal:0,2'],'notes'=>['sometimes','nullable','string','max:5000']];
    }
}
