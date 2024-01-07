<?php
    
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Http\Middleware\CheckSessionToken as Middleware;

class CheckSessionToken
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            $user = Auth::user();

            // Check if the stored session token matches the one in the database
            if ($user->remember_token !== $request->session()->getId()) {
                Auth::logout();

                // Redirect to the login page with a message indicating why the user was logged out
                return redirect()->route('login')->with('error', 'Your session has expired.');
            }
        }


        return $next($request);
    }
}

?>
