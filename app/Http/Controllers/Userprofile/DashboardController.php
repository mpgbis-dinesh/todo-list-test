<?php

namespace App\Http\Controllers\Userprofile;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\MasterTask;
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
use Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
	{
        if(Auth::check()){
            $updateTokenINDB = User::findOrFail(Auth::id());
            if( $updateTokenINDB->is_active == '1' && $updateTokenINDB->user_role == '2' ){
                
                // GET GROUP INFOMARTION
                $getGroupObj = DB::table('master_groups')
                                ->leftJoin('group_managements', 'master_groups.group_managements_id', '=', 'group_managements.id')
                                ->where('master_groups.users_id', '=', Auth::id())
                                ->select('group_managements.id', 'group_managements.name')
                                ->orderBy('group_managements.name', 'ASC')
                                ->get();
                return view('userprofile/dashboard.index', compact('getGroupObj'));
            }else{
                Auth::logout();
                Session::flash('confirmEmailPassword','Access Denied.');
                return Redirect::to('/');
            }
        }else{
            Auth::logout();
            return view('users.login');
        }
    }

    public function manageTaskStatusAction(Request $request, $group)
    {
        $getAllTasks = DB::table('master_tasks')
                            ->leftJoin('task_managements', 'master_tasks.task_managements_id', '=', 'task_managements.id')
                            ->where('master_tasks.group_managements_id', '=', $group)
                            ->select(
                                'master_tasks.id',
                                'task_managements.name',
                                'master_tasks.is_active'
                            )
                            ->orderBy('task_managements.name', 'ASC')
                            ->get();

        return view('userprofile/dashboard.manageTaskStatus', compact('getAllTasks'));
    }

    public function updateTaskStatusAction(Request $request)
    {
        $updateTask = MasterTask::findOrFail(Input::get('currentId'));
        $updateTask->is_active = Input::get('status');
        $updateTask->save();
        return response()->json([
                        'code' => 200,
                        'response' => 'success',
                    ]);
    }

    public function changePasswordAction(Request $request)
    {
        $user = User::findOrFail(Input::get('id'));
        $user->password              = Hash::make(Input::get('confirmPassword'));
        $user->save();

        return response()->json([
                        'code' => 200,
                        'response' => 'success',
                    ]);
    }
}