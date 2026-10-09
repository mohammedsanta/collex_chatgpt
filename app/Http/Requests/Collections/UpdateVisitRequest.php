<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('visits.update');
    }

    public function rules(): array
    {
        return [
            'scheduled_at' => ['sometimes','required','date'], 'address' => ['sometimes','nullable','string','max:500'], 'latitude' => ['sometimes','nullable','numeric','between:-90,90'], 'longitude' => ['sometimes','nullable','numeric','between:-180,180'], 'notes' => ['sometimes','nullable','string','max:5000'],
        ];
    }
}
