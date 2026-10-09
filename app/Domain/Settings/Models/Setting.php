<?php

declare(strict_types=1);

namespace App\Domain\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type', 'group', 'is_public'];

    protected function casts(): array
    {
        return ['is_public' => 'boolean'];
    }

    public function getTypedValueAttribute(): mixed
    {
        return match ($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOL),
            'integer' => (int) $this->value,
            'float' => (float) $this->value,
            'json', 'array' => json_decode((string) $this->value, true, flags: JSON_THROW_ON_ERROR),
            default => $this->value,
        };
    }
}
