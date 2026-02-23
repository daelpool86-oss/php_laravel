<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->token;
        if (!isset($apiKey)) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401,
                'information' => "user " .$request->name ." is not authorized to access this resource.",
            ], 401);
        }

        return $next($request);
    }
}
