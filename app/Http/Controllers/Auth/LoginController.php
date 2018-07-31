<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Request;
use Redirect;
use Input;
use Session;
use Hash;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if(Auth::check()){
            if( Auth::user()->user_role == 1):
                return Redirect::to('administration/dashbaord');
            else:
                return Redirect::to('dashbaord');            
            endif;
        }else{
            Auth::logout();
            return view('administration/user.login');    
        }        
    }

    public function doLogin(Request $request)
    {
        // create our user data for the authentication
        $userdata = array(
            'email'     => Input::get('email'),
            'password'  => Input::get('password')
        );
        
        // attempt to do the login
        if (Auth::attempt($userdata)) {
            $updateTokenINDB = User::findOrFail(Auth::id());

            $updateTokenINDB->apikey = Hash::make(date('Y-m-d H:i:s').'-'.$updateTokenINDB->id);
            $updateTokenINDB->save();

            if( $updateTokenINDB->user_role == 1):
                return Redirect::to('administration/dashbaord');            
            else:
                return Redirect::to('dashbaord');            
            endif;
        } else {
            Auth::logout();
            Session::flash('confirmEmailPassword','Entered email and password does not match.');
            return Redirect::to('/');
        }
    }
}
