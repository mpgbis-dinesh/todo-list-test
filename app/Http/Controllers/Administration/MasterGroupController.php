<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MasterGroup;
use Illuminate\Http\Request;

class MasterGroupController extends Controller
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
            $mastergroup = MasterGroup::where('users_id', 'LIKE', "%$keyword%")
                ->orWhere('group_managements_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $mastergroup = MasterGroup::latest()->paginate($perPage);
        }

        return view('administration.master-group.index', compact('mastergroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('administration.master-group.create');
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
        
        MasterGroup::create($requestData);

        return redirect('administration/master-group')->with('flash_message', 'MasterGroup added!');
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
        $mastergroup = MasterGroup::findOrFail($id);

        return view('administration.master-group.show', compact('mastergroup'));
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
        $mastergroup = MasterGroup::findOrFail($id);

        return view('administration.master-group.edit', compact('mastergroup'));
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
        
        $mastergroup = MasterGroup::findOrFail($id);
        $mastergroup->update($requestData);

        return redirect('administration/master-group')->with('flash_message', 'MasterGroup updated!');
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
        MasterGroup::destroy($id);

        return redirect('administration/master-group')->with('flash_message', 'MasterGroup deleted!');
    }
}
