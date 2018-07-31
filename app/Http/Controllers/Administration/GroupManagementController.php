<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GroupManagement;
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
use App\MasterGroup;
use App\MasterTask;
use App\Http\Controllers\Administration\UserController;


class GroupManagementController extends Controller
{
    protected $userController;
    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $group_management = GroupManagement::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $group_management = GroupManagement::latest()->paginate($perPage);
        }

        return view('administration.group-management.index', compact('group_management'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $getAllUsers = $this->userController->getAllUsers();
        $getAllMembers = [];
        return view('administration.group-management.create', compact('getAllUsers', 'getAllMembers'));
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
        
        $requestData = $request->all();
        $createGroup = GroupManagement::create($requestData);

        //ADD MEMBERS TO GROUP
        if(sizeof(Input::get('users')) > 0):
            foreach(Input::get('users') as $item):
                $addToGroup                         = New MasterGroup;
                $addToGroup->users_id               = $item;
                $addToGroup->group_managements_id   = $createGroup->id;
                $addToGroup->save();
            endforeach;
        endif;

        return redirect('administration/group-management')
                ->with('flash_message', 'New group added successfully!')
                ->with('alert_class', 'alert-success');
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
        $group_management = GroupManagement::findOrFail($id);

        $getAllMembers = DB::table('master_groups')
                            ->leftJoin('users', 'master_groups.users_id', '=', 'users.id')
                            ->where('group_managements_id', '=', $group_management->id)
                            ->select(
                                'users.id',
                                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS member")
                            )
                            ->orderBy('users.first_name', 'ASC')
                            ->get();

        $getAllTasks = DB::table('master_tasks')
                            ->leftJoin('task_managements', 'master_tasks.task_managements_id', '=', 'task_managements.id')
                            ->leftJoin('users', 'master_tasks.users_id', '=', 'users.id')
                            ->where('master_tasks.group_managements_id', '=', $group_management->id)
                            ->select(
                                'task_managements.id',
                                'task_managements.name',
                                'master_tasks.is_active',
                                'master_tasks.users_id',
                                DB::raw("CONCAT(users.first_name,' ',users.last_name) AS completedBy"),
                                'master_tasks.completed_on'
                            )
                            ->orderBy('task_managements.name', 'ASC')
                            ->get();


        return view('administration.group-management.show', compact('group_management', 'getAllMembers', 'getAllTasks'));
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
        $group_management = GroupManagement::findOrFail($id);
        $getAllUsers = $this->userController->getAllUsers();

        $getAllMembers = DB::table('master_groups')
                            ->leftJoin('users', 'master_groups.users_id', '=', 'users.id')
                            ->where('group_managements_id', '=', $group_management->id)
                            ->select(
                                'users.id',
                                DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS member")
                            )
                            ->orderBy('users.first_name', 'ASC')
                            ->get();

        return view('administration.group-management.edit', compact('group_management', 'getAllUsers', 'getAllMembers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $group_management = GroupManagement::findOrFail($id);
        $group_management->update($requestData);

        // DELETE OLD MEMBERS FROM GROUP
        DB::statement(DB::raw("DELETE FROM master_groups WHERE group_managements_id=".$id));

        //ADD MEMBERS TO GROUP
        if(sizeof(Input::get('users')) > 0):
            foreach(Input::get('users') as $item):
                $addToGroup                         = New MasterGroup;
                $addToGroup->users_id               = $item;
                $addToGroup->group_managements_id   = $id;
                $addToGroup->save();
            endforeach;
        endif;

        return redirect('administration/group-management')
                    ->with('flash_message', 'Group updated successfully!')
                    ->with('alert_class', 'alert-success');
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
        GroupManagement::destroy($id);

        return redirect('administration/group-management')
                    ->with('flash_message', 'Group deleted successfully!')
                    ->with('alert_class', 'alert-danger');
    }

    public function getGroupMembersAction()
    {
        $getMembers = DB::table('master_groups')
                        ->select('users_id')
                        ->get()
                        ;
        $dataArray['items'] = $getMembers;
        return Response::json($dataArray);
    }

    public function searchTasksAction(Request $request)
    {
        $getTasksObj = DB::table('task_managements')
                        ->where('task_managements.name', 'LIKE', '%'.Input::get('q').'%')
                        ->where('task_managements.is_active', '=' ,1)
                        ->select('id', 'name')
                        ->orderBy('name', 'ASC')
                        ->get();
        $dataArray['items'] = $getTasksObj;
        return Response::json($dataArray);
    }

    public function assignTasksAction(Request $request, $id)
    {
        $getAllTasks = DB::table('task_managements')
                        ->where('is_active', '=', 1)
                        ->select('id', 'name')
                        ->orderBy('name', 'ASC')
                        ->get()
                        ;

        $getAllAssignedTasks = DB::table('master_tasks')
                            ->leftJoin('task_managements', 'master_tasks.task_managements_id', '=', 'task_managements.id')
                            ->where('master_tasks.group_managements_id', '=', $id)
                            ->select(
                                'task_managements.id',
                                'task_managements.name',
                                'master_tasks.is_active'
                            )
                            ->orderBy('task_managements.name', 'ASC')
                            ->get();


        return view('administration.group-management.assignTasks', compact('id', 'getAllTasks', 'getAllAssignedTasks'));
    }

    public function manageTaskGroupActions(Request $request)
    {
        // DELETE OLD TASKS FROM GROUP
        DB::statement(DB::raw("DELETE FROM master_tasks WHERE group_managements_id=".Input::get('id')));

        if(sizeof(Input::get('tasks')) > 0):
            foreach(Input::get('tasks') as $value):
                $create = New MasterTask;
                $create->group_managements_id = Input::get('id');
                $create->task_managements_id  = $value;
                $create->save();
            endforeach;
        endif;

        return redirect('administration/group-management')
                ->with('flash_message', 'Tasks added successfully!')
                ->with('alert_class', 'alert-success');
    }
}