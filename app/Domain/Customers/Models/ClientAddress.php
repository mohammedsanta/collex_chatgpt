<?php

declare(strict_types=1);

namespace App\Domain\Customers\Models;

use Illuminate\Database\Eloquent\Model;

final class ClientAddress extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'address',
        'work_address',
    ];
}