<?php

declare(strict_types=1);

namespace App\Domain\Payments\Models;

use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Employees\Models\User;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'receipt_number',
        'debt_case_id',
        'collector_id',
        'promise_id',
        'amount',
        'method',
        'reference',
        'proof_path',
        'paid_at',
        'status',
        'confirmed_by',
        'confirmed_at',
        'rejection_reason',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'debt_case_id' => 'integer',
            'collector_id' => 'integer',
            'promise_id' => 'integer',
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'status' => 'string',
            'confirmed_by' => 'integer',
            'confirmed_at' => 'datetime',
        ];
    }

    public function debtCase(): BelongsTo
    {
        return $this->belongsTo(DebtCase::class);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    public function promise(): BelongsTo
    {
        return $this->belongsTo(PromiseToPay::class, 'promise_id');
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}