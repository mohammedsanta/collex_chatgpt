<?php

declare(strict_types=1);

namespace App\Domain\Collections\Models;

use App\Domain\Customers\Models\Client;
use App\Domain\Employees\Models\User;
use App\Domain\Institutions\Models\Bank;
use App\Domain\Loans\Models\DebtCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'complaints';

    protected $fillable = [
        'reference_number',
        'bank_id',
        'debt_case_id',
        'client_id',
        'logged_by',
        'assigned_to',
        'subject',
        'description',
        'source',
        'priority',
        'status',
        'due_at',
        'resolution',
        'resolved_by',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'bank_id' => 'integer',
            'debt_case_id' => 'integer',
            'client_id' => 'integer',
            'logged_by' => 'integer',
            'assigned_to' => 'integer',
            'due_at' => 'datetime',
            'resolved_by' => 'integer',
            'resolved_at' => 'datetime',
        ];
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function debtCase(): BelongsTo
    {
        return $this->belongsTo(DebtCase::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function loggedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'logged_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function resolvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}