<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Redirect user yang sudah login ke dashboard sesuai role-nya.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role?->name;

            return match($role) {
                'admin'  => redirect()->route('admin.dashboard'),
                'editor' => redirect()->route('editor.dashboard'),
                default  => redirect()->route('user.dashboard'),
            };
        }

        return $next($request);
    }
}
