<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsFreelancer
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'freelancer') {
            return $next($request);
        }
        return redirect('/')->with('error','You must be a freelancer to access this page.');
    }
}