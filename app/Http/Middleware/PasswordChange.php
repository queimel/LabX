<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class PasswordChange
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
        $user = $request->user();
        // $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);

        // if (Carbon::now()->diffInDays($password_changed_at) >= 30) {
        //     return redirect()->route('password.expired');
        // }

        if ( $user->password_changed_at === NULL )  {
            return redirect()->route('password.change');
        }


        return $next($request);
    }
}
