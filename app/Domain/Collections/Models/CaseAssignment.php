<?php

declare(strict_types=1);

namespace App\Domain\Collections\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class CaseAssignment extends Model
{
    use HasFactory;

    protected $table = 'case_assignments';

    protected $fillable = [
        'debt_case_id',
        'user_id',
        'assigned_by',
        'assigned_at',
        'unassigned_at',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'debt_case_id' => 'integer',
            'user_id' => 'integer',
            'assigned_by' => 'integer',
            'assigned_at' => 'datetime',
            'unassigned_at' => 'datetime',
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