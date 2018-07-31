<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $user = User::where('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orderBy('users.id', 'DESC')
                ->paginate($perPage, array('users.id', 'users.first_name', 'users.last_name', 'users.email', 'user_role', 'is_active'));

        return view('administration/user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administration/user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //CHECK EMAIL EXISTS
        $checkEmail = DB::table('users')
                    ->where('email', '=', Input::get('email'))
                    ->count()
                    ;

        if( $checkEmail == '0' ){
            $createUserObj              = New User();

            $createUserObj->first_name  = Input::get('first_name');
            $createUserObj->last_name   = Input::get('last_name');
            $createUserObj->phone       = Input::get('phone');
            $createUserObj->email       = Input::get('email');
            $createUserObj->password    = Hash::make(Input::get('password'));
            $createUserObj->apikey      = Input::get('apikey');
            $createUserObj->is_active   = Input::get('is_active');
            $createUserObj->user_role   = Input::get('user_role');

            $createUserObj->save();

            Session::flash('alert_class', 'alert-success');  
            Session::flash('flash_message', 'New User added!');    
        }else{
            Session::flash('alert_class', 'alert-danger');  
            Session::flash('flash_message', 'This email address is already exist with another user, try again with another user.');  
        }        

        return redirect('administration/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $getAllGroups = DB::table('master_groups')
                        ->leftJoin('group_managements', 'master_groups.group_managements_id', 'group_managements.id')
                        ->where('master_groups.users_id','=', $id)
                        ->select('group_managements.id', 'group_managements.name')
                        ->orderBy('group_managements.name', 'ASC')
                        ->get();
        
        return view('administration/user.show', compact('user', 'getAllGroups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user               = User::findOrFail($id);
        $submitButtonText   = 'Update';
        return view('administration/user.edit',compact('user', 'submitButtonText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {        
        try {
            $user = User::findOrFail($id);
            
            $user->first_name  = Input::get('first_name');
            $user->last_name   = Input::get('last_name');
            $user->phone       = Input::get('phone');
            $user->email       = Input::get('email');
            
            if( Input::get('password') != '' ){
                $user->password              = Hash::make(Input::get('password'));
            }

            $user->apikey      = Input::get('apikey');
            $user->is_active   = Input::get('is_active');
            $user->user_role   = Input::get('user_role');

            $user->save();

            Session::flash('flash_message', 'User updated!');
            Session::flash('alert_class', 'alert-success');             
        } catch (\Exception $e) {
            Session::flash('alert_class', 'alert-danger');  
            Session::flash('flash_message', 'This email address is already exist with another user, try again with another user.');
        }
        return redirect('administration/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('alert_class', 'alert-danger');  
        Session::flash('flash_message', 'User deleted!');

        return redirect('administration/user');
    }

    public function searchUserAction()
    {
        $getUsersObj = DB::table('users')
                        ->orWhere('users.first_name', 'LIKE', '%'.Input::get('q').'%')
                        ->orWhere('users.last_name', 'LIKE', '%'.Input::get('q').'%')
                        ->where('users.user_role', '=' ,2)
                        ->where('users.is_active', '=' ,1)
                        ->select('id', 'first_name', 'last_name')
                        ->orderBy('first_name', 'ASC')
                        ->get();
        $dataArray['items'] = $getUsersObj;
        return Response::json($dataArray);
    }

    public function getAllUsers()
    {
        $getAllUsers = DB::table('users')
                        ->where('users.is_active', '=', 1)
                        ->where('users.user_role', '=', 2)
                        ->select(
                            'users.id',
                            DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS userName")
                        )
                        ->orderBy('users.first_name', 'ASC')
                        ->get();
        return $getAllUsers;
    }
}
