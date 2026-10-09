<?php

declare(strict_types=1);

namespace App\Domain\Institutions\Models;

use App\Domain\Customers\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Governorate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}