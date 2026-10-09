<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Queries\SearchBanks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class BankSearchController extends Controller
{
    public function __invoke(Request $request, SearchBanks $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}