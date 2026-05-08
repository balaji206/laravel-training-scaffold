<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->user() || auth()->user()->role !== $role){
            abort(403,'You are not authorized to perform this action');
        }
        return $next($request);
    }
}