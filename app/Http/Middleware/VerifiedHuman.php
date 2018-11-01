<?php

namespace App\Http\Middleware;

use App\Models\Human;
use Closure;

class VerifiedHuman
{
    public function handle($request, Closure $next)
    {
        if (app()->runningUnitTests() || Human::isReal()) {
            return $next($request);
        }

        session()->put('human-redirect', $request->url());

        return redirect()->route('humanVerification');
    }
}
