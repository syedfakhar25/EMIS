<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = null;

        if(auth()->user()->usertype == "admin")
        {
            $collection = Department::all();
        }
        elseif(auth()->user()->usertype == "department_admin")
        {
            $collection = Department::where('dep_id', auth()->user()->dep_id)->get();
        }

        return view('sub-departments.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_designations = Department::where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
        return view('sub-departments.create', compact('parent_designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->all());
        $parent_id = Department::find($request->dep_id);
        $name = $request->name;

        $request->merge(['parent_id' => $request->dep_id]);
        $request->merge(['dep_name' => $name]);
        $request->merge(['short_name' => $name]);
        $department = Department::create($request->all());
//        dd($request->all());

//        dd($parent_id);
//        $sd = SubDepartment::create($request->all());
        session()->flash('message', 'Sub department successfully created.');
        return redirect()->route('sub-departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubDepartment  $subDepartment
     * @return \Illuminate\Http\Response
     */
    public function show(SubDepartment $subDepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubDepartment  $subDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit(SubDepartment $subDepartment)
    {
        $parent_designations = Department::where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
        return view('sub-departments.edit', compact('parent_designations', 'subDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubDepartment  $subDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubDepartment $subDepartment)
    {
        $subDepartment->update($request->all());
        session()->flash('message', 'Sub department updated successfully.');
        return redirect()->route('sub-departments.edit', $subDepartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubDepartment  $subDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDepartment $subDepartment)
    {
        //
    }
}
