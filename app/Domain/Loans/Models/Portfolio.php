<?php

declare(strict_types=1);

namespace App\Domain\Loans\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Portfolio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'portfolios';

    protected $fillable = [
        'bank_id',
        'name',
        'period_year',
        'period_month',
        'status',
        'cases_count',
        'total_debt',
        'created_by',
        'activated_at',
        'archived_at',
        'archived_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'bank_id' => 'integer',
            'period_year' => 'integer',
            'period_month' => 'integer',
            'cases_count' => 'integer',
            'total_debt' => 'decimal:2',
            'created_by' => 'integer',
            'archived_by' => 'integer',
            'activated_at' => 'datetime',
            'archived_at' => 'datetime',
        ];
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function archivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archived_by');
    }

    public function imports(): HasMany
    {
        return $this->hasMany(PortfolioImport::class);
    }

    public function debtCases(): HasMany
    {
        return $this->hasMany(DebtCase::class);
    }
}