<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use storeHash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use Log;
use PDF;
use Config;
use File;
use Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
	{
        if(Auth::check()){
            $updateTokenINDB = User::findOrFail(Auth::id());
            if( $updateTokenINDB->is_active == '1' && $updateTokenINDB->user_role == '1' ){
                //GET TOTAL USERS COUNT
                $getTotalUsers = DB::table('users')
                                    ->where('users.is_active', '=', 1)
                                    ->where('users.user_role', '=', 2)
                                    ->count();
                $getTotalActiveUsers = DB::table('users')
                                    ->where('users.is_active', '=', 1)
                                    ->where('users.user_role', '=', 2)
                                    ->count();

                // GET TOTAL GROUPS COUNT
                $getTotalGroups = DB::table('group_managements')
                                    ->count();
                $getTotalActiveGroups = DB::table('group_managements')
                                        ->where('is_active', '=', 1)
                                        ->count();

                // GET TOTAL TASKS COUNT
                $getTotalTasks = DB::table('task_managements')
                                    ->count();
                $getTotalActiveTasks = DB::table('task_managements')
                                        ->where('is_active', '=', 1)
                                        ->count();


                return view('administration/dashboard.index', compact('getTotalUsers', 'getTotalActiveUsers' ,'getTotalGroups', 'getTotalActiveGroups', 'getTotalTasks', 'getTotalActiveTasks'));
            }else{
                Auth::logout();
                // Session::flash('confirmEmailPassword','Entered email and password does not match.');
                return Redirect::to('/');
            }
        }else{
            Auth::logout();
            return view('users.login');
        }
	}

    public function homeAction(){
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
}