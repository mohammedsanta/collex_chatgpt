<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Queries\SearchLoanTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class LoanTypeSearchController extends Controller
{
    public function __invoke(Request $request, SearchLoanTypes $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}