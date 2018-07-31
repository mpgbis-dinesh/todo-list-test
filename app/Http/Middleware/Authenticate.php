<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use Session;
use App;
use Request;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if( Auth::check() ){
            //VALIDATE WITHT THE ADMIN ROLE
            $validateWithApplicantRole = DB::table('users')
                                        ->where('users.id', '=', AUTH::id())
                                        ->where('users.is_active', '=', '1')
                                        ->count()
                                        ;                
            if( $validateWithApplicantRole == '1' ){
                if( env('APP_DEBUG') == 0 ){
                    if(!$request->secure()) {
                        // return $next($request);
                       return redirect()->secure($request->path());
                    }    
                }else{
                  if ($this->auth->guest()) {
                        return $next($request);
                    }  
                }
                return $next($request);
            }else{
                Auth::logout();
                Session::flash('confirmEmailPassword', 'Access Denied.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/');    
            }
        }else{
            Auth::logout();
            Session::flash('confirmEmailPassword', 'Access Denied.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
        // return $next($request);
    }
}
