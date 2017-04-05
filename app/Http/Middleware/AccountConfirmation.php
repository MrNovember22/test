<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccountConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->status_id === 0)
            {
                return redirect('/user/confirm');
            } elseif ($user->status_id === 1)
                {
                    return $next($request);
                }
        }
        return $next($request);
    }
}