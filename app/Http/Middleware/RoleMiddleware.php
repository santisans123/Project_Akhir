<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Exception\FirebaseException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uid = Session::get('uid');
        if($uid == null)
            return redirect()->route('login');
        $email = app('firebase.auth')->getUser($uid)->email;
        if ($email == 'admin@admin.com') {
            return $next($request);
        }

        return redirect()->route('datatambak');
        // if ($verify == 1) {
        //     return redirect()->route('datatambak');
        // } else {
        //     try {
        //         $link = app('firebase.auth')->sendEmailVerificationLink($email);
        //     } catch (FirebaseException $e) {
        //         Session::flash('error', $e->getMessage());
        //     }
        //     return redirect()->route('verify');
        // }
    }
}
