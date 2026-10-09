<?php

declare(strict_types=1);

namespace App\Domain\Reports\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class DailyCollectionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'user_id',
        'report_date',
        'cases_worked',
        'calls_count',
        'visits_count',
        'promises_count',
        'promised_amount',
        'collected_amount',
        'status',
        'submitted_at',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'bank_id' => 'integer',
            'user_id' => 'integer',
            'report_date' => 'date',
            'cases_worked' => 'integer',
            'calls_count' => 'integer',
            'visits_count' => 'integer',
            'promises_count' => 'integer',
            'promised_amount' => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'submitted_at' => 'datetime',
            'approved_by' => 'integer',
            'approved_at' => 'datetime',
        ];
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}