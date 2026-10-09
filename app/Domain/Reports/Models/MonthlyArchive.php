<?php

declare(strict_types=1);

namespace App\Domain\Reports\Models;

use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class MonthlyArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'portfolio_id',
        'year',
        'month',
        'cases_count',
        'total_debt',
        'collected_amount',
        'snapshot_path',
        'archived_by',
        'archived_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'bank_id' => 'integer',
            'portfolio_id' => 'integer',
            'year' => 'integer',
            'month' => 'integer',
            'cases_count' => 'integer',
            'total_debt' => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'archived_by' => 'integer',
            'archived_at' => 'datetime',
        ];
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function archivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archived_by');
    }
}