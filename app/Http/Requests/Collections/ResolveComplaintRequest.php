<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class ResolveComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('complaints.resolve');
    }

    public function rules(): array
    {
        return [
            'resolution' => ['required','string','min:3','max:5000'],
        ];
    }
}
