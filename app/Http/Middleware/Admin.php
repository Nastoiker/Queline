<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = User::findOrFail($token->tokenable_id);

        if ($user->role_id !== 1) {
            return response()->json([
                'message' => 'Доступ ограничен'
            ], 403);
        }

        return $next($request);
    }
}
