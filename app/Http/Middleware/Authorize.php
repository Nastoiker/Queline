<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if (empty($token)) {
            return response()->json([
                'error' => 'Сначала авторизируйтесь'
            ], 403, [
                'Content-type' => 'application/json'
            ]);
        }
        return $next($request);
    }
}
