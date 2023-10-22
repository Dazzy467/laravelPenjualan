<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class check_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {

        if (Auth::check() && Auth::user()->role == $roles) {
            return $next($request);
        }
        // return redirect('/')->with('error','Access denied');
        return redirect()->route('home')->with('error', 'Only admin are prohibited');
    }
}
