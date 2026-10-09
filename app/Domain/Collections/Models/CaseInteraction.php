<?php

declare(strict_types=1);

namespace App\Domain\Collections\Models;

use App\Domain\Customers\Models\ClientPhone;
use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class CaseInteraction extends Model
{
    use HasFactory;

    protected $table = 'case_interactions';

    protected $fillable = [
        'debt_case_id',
        'user_id',
        'client_phone_id',
        'type',
        'outcome',
        'notes',
        'duration_seconds',
        'occurred_at',
        'followup_at',
    ];

    protected function casts(): array
    {
        return [
            'debt_case_id' => 'integer',
            'user_id' => 'integer',
            'client_phone_id' => 'integer',
            'duration_seconds' => 'integer',
            'occurred_at' => 'datetime',
            'followup_at' => 'datetime',
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

    public function clientPhone(): BelongsTo
    {
        return $this->belongsTo(ClientPhone::class);
    }
}