<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KasirMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (
            $user->role == 'kasir' ||
            $user->role == 'admin' ||
            $user->is_super_admin
        ) {
            return $next($request);
        }

        abort(403);
    }
}