<?php

namespace App\Http\Middleware;

use Closure;

class VerifyBase64Token
{
    private $fullname = 'Ilham Nuruddin Al Huda';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $this->getTokenFromRequest($request);

        $this->tokenMatch($token);

        return $next($request);
    }

    public function getTokenFromRequest($request)
    {
        $authorization = $request->header('Authorization');

        if (! $authorization) {
            return response()->json(['error' => 'Authorization header not found.'], 401);
        }

        $tokenParts = explode(' ', $authorization);

        if (count($tokenParts) !== 2 || $tokenParts[0] !== 'Bearer') {
            return response()->json(['error' => 'Invalid Authorization header format.'], 401);
        }

        return $tokenParts[1];
    }

    public function tokenMatch($token)
    {
        if (is_string($token) &&
            ! hash_equals($this->fullname, base64_decode($token))) {
            return response()->json(['error' => 'Invalid Bearer Token.'], 401);
        }
    }
}
