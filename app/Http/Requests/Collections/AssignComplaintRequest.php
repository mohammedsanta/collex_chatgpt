<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class AssignComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.assign');
    }

    public function rules(): array
    {
        return [
            'assigned_to' => ['required','integer','exists:users,id'],
        ];
    }
}
