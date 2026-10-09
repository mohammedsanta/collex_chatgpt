<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

final class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowed = ['ar', 'en'];
        $requested = $request->user()?->locale ?? $request->session()->get('locale', config('app.locale'));
        App::setLocale(in_array($requested, $allowed, true) ? $requested : 'ar');

        return $next($request);
    }
}
