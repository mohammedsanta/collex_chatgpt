<?php

declare(strict_types=1);

namespace App\Domain\Collections\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Visit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'visits';

    protected $fillable = [
        'debt_case_id',
        'user_id',
        'assigned_by',
        'status',
        'scheduled_at',
        'visited_at',
        'address',
        'latitude',
        'longitude',
        'outcome',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'debt_case_id' => 'integer',
            'user_id' => 'integer',
            'assigned_by' => 'integer',
            'scheduled_at' => 'datetime',
            'visited_at' => 'datetime',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function debtCase(): BelongsTo
    {
        return $this->belongsTo(DebtCase::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}