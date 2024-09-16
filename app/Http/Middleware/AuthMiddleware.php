<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, string $guard = 'api'): JsonResponse
    {
        try {
            $user = Auth::guard($guard)->authenticate();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
