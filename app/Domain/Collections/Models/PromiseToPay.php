<?php

declare(strict_types=1);

namespace App\Domain\Collections\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class PromiseToPay extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'promises_to_pay';

    protected $fillable = [
        'debt_case_id',
        'user_id',
        'promised_amount',
        'paid_amount',
        'promise_date',
        'status',
        'notes',
        'reviewed_by',
        'reviewed_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'debt_case_id' => 'integer',
            'user_id' => 'integer',
            'promised_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'promise_date' => 'date',
            'reviewed_by' => 'integer',
            'reviewed_at' => 'datetime',
            'closed_at' => 'datetime',
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

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'promise_id');
    }
}