<?php

declare(strict_types=1);

namespace App\Domain\Loans\Models;

use App\Domain\Employees\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PortfolioImport extends Model
{
    use HasFactory;

    protected $table = 'portfolio_imports';

    protected $fillable = [
        'portfolio_id',
        'imported_by',
        'original_filename',
        'stored_path',
        'status',
        'total_rows',
        'success_rows',
        'failed_rows',
        'errors',
        'started_at',
        'finished_at',
    ];

    protected function casts(): array
    {
        return [
            'portfolio_id' => 'integer',
            'imported_by' => 'integer',
            'total_rows' => 'integer',
            'success_rows' => 'integer',
            'failed_rows' => 'integer',
            'errors' => 'array',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function importedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'imported_by');
    }
}