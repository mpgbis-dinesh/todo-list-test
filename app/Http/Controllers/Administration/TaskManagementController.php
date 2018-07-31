<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TaskManagement;
use App\MasterTask;
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

class TaskManagementController extends Controller
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

        if (!empty($keyword)) {
            $taskmanagement = TaskManagement::where('name', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $taskmanagement = TaskManagement::latest()->paginate($perPage);
        }

        return view('administration.task-management.index', compact('taskmanagement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administration.task-management.create');
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
        $createTask = TaskManagement::create($requestData);

        return redirect('administration/task-management')
                ->with('flash_message', 'New Task added!')
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
        $taskmanagement = TaskManagement::findOrFail($id);

        return view('administration.task-management.show', compact('taskmanagement'));
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
        $taskmanagement = TaskManagement::findOrFail($id);

        return view('administration.task-management.edit', compact('taskmanagement'));
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
        
        $taskmanagement = TaskManagement::findOrFail($id);
        $taskmanagement->update($requestData);

        return redirect('administration/task-management')
                ->with('flash_message', 'Task updated!')
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
        TaskManagement::destroy($id);

        return redirect('administration/task-management')
                ->with('flash_message', 'Task deleted!')
                ->with('alert_class', 'alert-success');
    }
}
