<?php

declare(strict_types=1);

namespace App\Domain\Reports\Models;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ReportExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'format',
        'filters',
        'status',
        'file_path',
        'row_count',
        'error',
        'generated_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'filters' => 'array',
            'row_count' => 'integer',
            'generated_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}