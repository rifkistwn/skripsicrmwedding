<?php

namespace App\Http\Middleware;

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
        if (!$request->expectsJson()) {
            $active_route = $_SERVER['REQUEST_URI'];

            if (strpos($active_route, "admin") !== false) {
                return route('admin.login');
            }

            return route('login');
        }
    }
}
