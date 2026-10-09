<?php

declare(strict_types=1);

namespace App\Http\Controllers\Institutions;

use App\Domain\Institutions\Queries\SearchGovernorates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class GovernorateSearchController extends Controller
{
    public function __invoke(Request $request, SearchGovernorates $query)
    {
        return $query->execute(
            (string) $request->string('search')
        );
    }
}