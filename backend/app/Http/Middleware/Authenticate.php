<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //return route('login');
            //return abort(response()->json(['message' => 'Unauthorized'], 401));

            if ($request->expectsJson()) {
                abort(response()->json(['message' => 'Unauthorized'], 401));
            }

            // return route('login');
        }
    }
    // protected function authenticate($request, array $guards)
    // {
    //     if ($this->auth->guard('customer')->check()) {
    //         return $this->auth->shouldUse('customer');
    //     }

    //     throw new AuthenticationException(
    //         'Unauthenticated.',
    //         $guards,
    //         $this->redirectTo($request)
    //     );
    // }
}
