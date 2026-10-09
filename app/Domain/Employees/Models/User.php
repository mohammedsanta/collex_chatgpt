<?php

declare(strict_types=1);

namespace App\Domain\Employees\Models;

use App\Domain\Institutions\Models\Bank;
use App\Domain\Institutions\Models\InstallmentCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'supervisor_id',
        'status',
        'is_system_account',
        'avatar_path',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role_id' => 'integer',
            'supervisor_id' => 'integer',
            'is_system_account' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(self::class, 'supervisor_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(self::class, 'supervisor_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)
            ->withPivot('granted')
            ->withTimestamps();
    }

    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class)
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    public function installmentCompanies(): BelongsToMany
    {
        return $this->belongsToMany(InstallmentCompany::class)
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    public function hasPermission(string $permissionName): bool
    {
        if ($this->is_system_account) {
            return true;
        }

        $directPermission = $this->permissions()
            ->where('permissions.name', $permissionName)
            ->first();

        if ($directPermission !== null) {
            return (bool) $directPermission->pivot->granted;
        }

        return $this->role()
            ->with('permissions')
            ->first()?->permissions
            ->contains('name', $permissionName) ?? false;
    }

    public function hasRole(string $roleName): bool
    {
        return $this->role()->where('name', $roleName)->exists();
    }

}