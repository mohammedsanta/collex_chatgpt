<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class RejectComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.reject');
    }

    public function rules(): array
    {
        return [
            'reason' => ['required','string','min:3','max:5000'],
        ];
    }
}
