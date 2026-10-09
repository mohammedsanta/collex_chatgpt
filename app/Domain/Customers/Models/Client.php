<?php

declare(strict_types=1);

namespace App\Domain\Customers\Models;

use App\Domain\Institutions\Models\Governorate;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'clients';

    protected $fillable = [
        'code',
        'national_id',
        'name',
        'email',
        'governorate_id',
        'address',
        'employer_name',
        'job_title',
        'work_address',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'governorate_id' => 'integer',
        ];
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(ClientPhone::class);
    }

    public function debtCases(): HasMany
    {
        return $this->hasMany(DebtCase::class);
    }
}