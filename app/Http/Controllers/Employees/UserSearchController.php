<?php

declare(strict_types=1);

namespace App\Http\Controllers\Employees;

use App\Domain\Employees\Queries\SearchUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class UserSearchController extends Controller
{
    public function __invoke(Request $request, SearchUsers $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}