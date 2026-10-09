<?php

declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Domain\Customers\Queries\SearchClients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class ClientSearchController extends Controller
{
    public function __invoke(Request $request, SearchClients $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}