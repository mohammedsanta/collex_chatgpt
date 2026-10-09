<?php

declare(strict_types=1);

namespace App\Http\Controllers\Loans;

use App\Domain\Loans\Queries\SearchDebtCases;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class DebtCaseSearchController extends Controller
{
    public function __invoke(Request $request, SearchDebtCases $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}