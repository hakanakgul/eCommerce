<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //need check if user is admin
        dd((Auth::user()->role_as));
        if (!Auth::user()->role_as == 20) {
            dd("geldi");
            return redirect("/home")->with('status', 'You are not authorized to access this page.');
        }
        dd("geldi next");
        return $next($request);
    }
}