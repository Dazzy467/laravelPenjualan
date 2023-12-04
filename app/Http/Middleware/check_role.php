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
        // Admin bisa akses semua fitur
        if (Auth::check() && Auth::user()->role == $roles || Auth::user()->role == 0) {
            return $next($request);
        }

        else {
            if ($roles == 0 && Auth::user()->role != $roles)
            {
                if(Auth::user()->role == 1)
                    return redirect()->route('kasir.show')->with('error', 'Hanya admin yang boleh masuk');
            }
                
            else if ($roles == 1 && Auth::user()->role != $roles)
                return redirect()->route('home')->with('error', 'Hanya kasir yang boleh masuk');
            else if ($roles == 2 && Auth::user()->role != $roles)
                return redirect()->route('home')->with('error', 'Hanya admin gudang yang boleh masuk');
        }
        // return redirect('/')->with('error','Access denied');

    }
}
