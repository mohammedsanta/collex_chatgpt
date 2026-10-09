<?php

declare(strict_types=1);

namespace App\Http\Requests\Collections;

use Illuminate\Foundation\Http\FormRequest;

final class UpdatePromiseToPayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->hasPermission('promises.update');
    }

    public function rules(): array
    {
        return [
            'promised_amount' => ['sometimes','required','numeric','gt:0','decimal:0,2'], 'promise_date' => ['sometimes','required','date'], 'notes' => ['sometimes','nullable','string','max:5000'],
        ];
    }
}
