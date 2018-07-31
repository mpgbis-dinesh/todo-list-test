<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MasterTask;
use Illuminate\Http\Request;

class MasterTasksController extends Controller
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
            $mastertasks = MasterTask::where('group_managements_id', 'LIKE', "%$keyword%")
                ->orWhere('task_managements', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $mastertasks = MasterTask::latest()->paginate($perPage);
        }

        return view('administration.master-tasks.index', compact('mastertasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administration.master-tasks.create');
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
        
        MasterTask::create($requestData);

        return redirect('administration/master-tasks')->with('flash_message', 'MasterTask added!');
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
        $mastertask = MasterTask::findOrFail($id);

        return view('administration.master-tasks.show', compact('mastertask'));
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
        $mastertask = MasterTask::findOrFail($id);

        return view('administration.master-tasks.edit', compact('mastertask'));
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
        
        $mastertask = MasterTask::findOrFail($id);
        $mastertask->update($requestData);

        return redirect('administration/master-tasks')->with('flash_message', 'MasterTask updated!');
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
        MasterTask::destroy($id);

        return redirect('administration/master-tasks')->with('flash_message', 'MasterTask deleted!');
    }
}
