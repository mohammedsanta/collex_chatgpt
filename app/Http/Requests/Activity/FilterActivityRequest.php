<?php

declare(strict_types=1);

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

final class FilterActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null
            && $user->hasPermission('activity.view');
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'action' => ['nullable', 'string', 'max:100'],
            'date_from' => ['nullable', 'date'],
            'date_to' => [
                'nullable',
                'date',
                'after_or_equal:date_from',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'search.max' => 'نص البحث يجب ألا يتجاوز 255 حرفًا.',
            'action.max' => 'قيمة نوع النشاط غير صحيحة.',
            'date_from.date' => 'تاريخ البداية غير صحيح.',
            'date_to.date' => 'تاريخ النهاية غير صحيح.',
            'date_to.after_or_equal' => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية أو مساويًا له.',
        ];
    }
}