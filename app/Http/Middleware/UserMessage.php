<?php

namespace App\Http\Middleware;

use App\Message;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserMessage
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
        /*
         * Retrieve message using url
         */
        $url = $request->segment(3);
        $message = Message::find($url);

        if ($user->id == $message->user_id)
        {
            return $next($request);
        }

        abort(404, 'Page Does Not Exists');
    }
}
