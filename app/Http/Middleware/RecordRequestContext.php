<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RecordRequestContext
{
    public function handle(Request $request, Closure $next): Response
    {
        // Request context is deliberately not logged here to avoid recording
        // passwords, tokens, or other sensitive request payloads.
        return $next($request);
    }
}
