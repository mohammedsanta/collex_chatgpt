<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\Loans\Models\Portfolio;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PreventArchivedPortfolioMutation
{
    public function handle(Request $request, Closure $next): Response
    {
        $portfolio = $request->route('portfolio');

        if (
            $portfolio instanceof Portfolio &&
            $portfolio->status === 'archived' &&
            !$request->isMethod('GET')
        ) {
            abort(409, 'Archived portfolios are read-only.');
        }

        return $next($request);
    }
}