<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GateApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $apiKey = $request->header('x-api-key');

        $validApiKey = config('gate.api_key');
        if (!$apiKey || $apiKey !== $validApiKey) {
            return response()->json([
                'message' => 'Unauthorized - Invalid API Key'
            ], 401);
        }
        return $next($request);
    }
}
