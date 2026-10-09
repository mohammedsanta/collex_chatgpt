<?php

declare(strict_types=1);

namespace App\Domain\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ClientPhone extends Model
{
    use HasFactory;

    protected $table = 'client_phones';

    protected $fillable = [
        'client_id',
        'phone',
        'label',
        'is_valid',
    ];

    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'is_valid' => 'boolean',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}