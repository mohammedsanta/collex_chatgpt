<?php

declare(strict_types=1);

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

final class StoreReportExportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null
            && $this->user()->hasPermission('reports.exports.create');
    }

    public function rules(): array
    {
        return [
            'type' => [
                'required',
                'string',
                'in:collection,performance,payment,portfolio,dcr',
            ],

            'format' => [
                'required',
                'string',
                'in:xlsx,csv,pdf',
            ],

            'filters' => [
                'nullable',
                'array',
            ],

            'filters.date_from' => [
                'nullable',
                'date_format:Y-m-d',
            ],

            'filters.date_to' => [
                'nullable',
                'date_format:Y-m-d',
                'after_or_equal:filters.date_from',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'يرجى اختيار نوع التقرير.',
            'type.in' => 'نوع التقرير المحدد غير مدعوم.',
            'format.required' => 'يرجى اختيار صيغة الملف.',
            'format.in' => 'صيغة الملف المحددة غير مدعومة.',
            'filters.date_from.date_format' => 'تاريخ البداية غير صالح.',
            'filters.date_to.date_format' => 'تاريخ النهاية غير صالح.',
            'filters.date_to.after_or_equal' => 'تاريخ النهاية يجب ألا يسبق تاريخ البداية.',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $from = $this->input('filters.date_from');
                $to = $this->input('filters.date_to');

                if ($from && $to && $from > $to) {
                    $validator->errors()->add(
                        'filters.date_to',
                        'تاريخ النهاية يجب ألا يسبق تاريخ البداية.',
                    );
                }
            },
        ];
    }
}