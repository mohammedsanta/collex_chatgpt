<?php

declare(strict_types=1);

namespace App\Domain\Reports\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PerformanceSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'year',
        'month',
        'cases_assigned',
        'cases_processed',
        'promises_total',
        'promises_kept',
        'promises_broken',
        'collected_amount',
        'target_amount',
        'efficiency',
        'rank_position',
        'calculated_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'bank_id' => 'integer',
            'year' => 'integer',
            'month' => 'integer',
            'cases_assigned' => 'integer',
            'cases_processed' => 'integer',
            'promises_total' => 'integer',
            'promises_kept' => 'integer',
            'promises_broken' => 'integer',
            'collected_amount' => 'decimal:2',
            'target_amount' => 'decimal:2',
            'efficiency' => 'decimal:2',
            'rank_position' => 'integer',
            'calculated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}