<?php
namespace App\Http\Middleware;
use Closure,Config;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        $user = Auth::user();
        if(!empty($user)&& $user->user_id != Config::get('constants.ADMIN_ROLE'))
        {
            Auth::logout();
            Session::flush();
            return redirect('/');
        }
        return $next($request);
    } 
}