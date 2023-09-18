<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->usertype == "admin") {
            $categories = Designation::where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            return view('designation.index', compact('categories'));

        } elseif (auth()->user()->usertype == "department_admin") {
          
            $categories = Designation::where('dep_id', auth()->user()->dep_id)->where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            return view('designation.index', compact('categories'));
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->usertype == "admin") {
            $parent_designations = Designation::where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            $parent_departments = Department::where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
            return view('designation.create', compact('parent_designations','parent_departments'));
        } elseif (auth()->user()->usertype == "department_admin") {
            $parent_departments = Department::where('id', auth()->user()->dep_id)->where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
            $parent_designations = Designation::where('dep_id', auth()->user()->dep_id)->where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            return view('designation.create', compact('parent_designations','parent_departments'));
        } else {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designation = Designation::find($request->designation_id);
        $request->merge(['dep_id' => $request->dep_id]);
        $request->merge(['parent_id' => $request->designation_id]);
        $request->merge(['name' => $request->designation_name]);
        $designation = Designation::create($request->all());
        session()->flash('message', 'Designation successfully added.');
        return redirect()->route('designation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {


        if (auth()->user()->usertype == "admin") {
            $des = $designation;
            $departments = Department::all();
            $parent_designations = Designation::where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            $parent_departments = Department::where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
            return view('designation.edit', compact('departments', 'parent_designations', 'des', 'parent_departments'));

        } elseif (auth()->user()->usertype == "department_admin") {
            $des = $designation;

            $departments = Department::all();
            $parent_designations = Designation::where('dep_id', auth()->user()->dep_id)->where('parent_id', 0)->orderBy('designation_name', 'asc')->get();
            $parent_departments = Department::where('id', auth()->user()->dep_id)->where('parent_id', 0)->orderBy('dep_name', 'asc')->get();
            return view('designation.edit', compact('departments', 'parent_designations', 'des', 'parent_departments'));

        } else {
            return abort(403);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {

        if ($request->parent_id == $request->id) {
            $designation->dep_id = $request->dep_id;
            $designation->designation_name = $request->designation_name;
            $designation->save();
            session()->flash('message', 'Designation successfully updated.');
            return redirect()->route('designation.index');
        } else {
            $designation->update($request->all());
            session()->flash('message', 'Designation successfully updated.');
            return redirect()->route('designation.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
    }
}
