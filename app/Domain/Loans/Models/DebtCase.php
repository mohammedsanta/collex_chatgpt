<?php

declare(strict_types=1);

namespace App\Domain\Loans\Models;

use App\Domain\Collections\Models\CaseAssignment;
use App\Domain\Collections\Models\CaseInteraction;
use App\Domain\Collections\Models\Complaint;
use App\Domain\Collections\Models\PromiseToPay;
use App\Domain\Collections\Models\Visit;
use App\Domain\Customers\Models\Client;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Institutions\Models\LoanType;
use App\Domain\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class DebtCase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'debt_cases';

    protected $fillable = [
        'portfolio_id',
        'bank_id',
        'client_id',
        'loan_type_id',
        'assigned_user_id',
        'loan_number',
        'status',
        'total_debt',
        'overdue_amount',
        'installment_value',
        'min_installment_diff',
        'late_fee',
        'collected_amount',
        'bucket',
        'dpd',
        'next_due_date',
        'loan_start_date',
        'loan_end_date',
        'last_payment_date',
        'last_payment_amount',
        'is_processed',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'portfolio_id' => 'integer',
            'bank_id' => 'integer',
            'client_id' => 'integer',
            'loan_type_id' => 'integer',
            'assigned_user_id' => 'integer',
            'total_debt' => 'decimal:2',
            'overdue_amount' => 'decimal:2',
            'installment_value' => 'decimal:2',
            'min_installment_diff' => 'decimal:2',
            'late_fee' => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'dpd' => 'integer',
            'next_due_date' => 'date',
            'loan_start_date' => 'date',
            'loan_end_date' => 'date',
            'last_payment_date' => 'date',
            'last_payment_amount' => 'decimal:2',
            'is_processed' => 'boolean',
            'processed_at' => 'datetime',
        ];
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function loanType(): BelongsTo
    {
        return $this->belongsTo(LoanType::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(CaseAssignment::class);
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(CaseInteraction::class);
    }

    public function promisesToPay(): HasMany
    {
        return $this->hasMany(PromiseToPay::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}