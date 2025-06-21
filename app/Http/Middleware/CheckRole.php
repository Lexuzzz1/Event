<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response $next
     * @param string $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Asumsi kolom role_id ada di model User dan sudah punya relasi 'role'
        if (!$request->user() || $request->user()->role?->name !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
