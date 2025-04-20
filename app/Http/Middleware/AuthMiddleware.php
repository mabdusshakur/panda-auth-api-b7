<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $secret_key = env('JWT_SECRET');

        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));

        if(!$decoded->user_id == 1){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
