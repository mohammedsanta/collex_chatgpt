<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class CreateVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('visits.create');
    }

    public function rules(): array
    {
        return [
            'debt_case_id' => ['required','integer','exists:debt_cases,id'], 'user_id' => ['nullable','integer','exists:users,id'], 'scheduled_at' => ['required','date'], 'address' => ['nullable','string','max:500'], 'latitude' => ['nullable','numeric','between:-90,90'], 'longitude' => ['nullable','numeric','between:-180,180'], 'notes' => ['nullable','string','max:5000'],
        ];
    }
}
