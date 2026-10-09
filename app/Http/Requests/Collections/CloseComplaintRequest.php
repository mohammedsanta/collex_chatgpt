<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class CloseComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.close');
    }

    public function rules(): array
    {
        return [
            'resolution' => ['nullable','string','max:5000'],
        ];
    }
}
