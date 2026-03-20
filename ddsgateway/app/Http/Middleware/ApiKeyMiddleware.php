<?php
namespace App\Http\Middleware;

use Closure;

class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');
        
        // You can store valid keys in .env or database
        $validKey = env('API_SECRET_KEY', 'your-secret-key-here');
        
        if (!$apiKey || $apiKey !== $validKey) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $next($request);
    }
}
