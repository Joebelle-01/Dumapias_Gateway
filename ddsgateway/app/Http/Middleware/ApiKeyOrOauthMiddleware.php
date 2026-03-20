<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

class ApiKeyOrOauthMiddleware
{
    /**
     * @var \Laravel\Passport\Http\Middleware\CheckClientCredentials
     */
    private $passport;

    public function __construct(CheckClientCredentials $passport)
    {
        $this->passport = $passport;
    }

    public function handle($request, Closure $next)
    {
        $apiKey = (string) $request->header('X-API-Key', '');
        $validKey = (string) env('API_SECRET_KEY', 'your-secret-key-here');

        if ($apiKey !== '' && $validKey !== '' && hash_equals($validKey, $apiKey)) {
            return $next($request);
        }

        try {
            // Validates Authorization: Bearer <token> using Passport (client credentials or user tokens).
            return $this->passport->handle($request, $next);
        } catch (MissingScopeException $e) {
            return response()->json(['error' => 'Forbidden'], 403);
        } catch (AuthenticationException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}

