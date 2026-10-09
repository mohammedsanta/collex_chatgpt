<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Models;

use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class LoanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function debtCases(): HasMany
    {
        return $this->hasMany(DebtCase::class);
    }
}