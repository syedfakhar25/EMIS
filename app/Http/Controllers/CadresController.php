<?php

namespace App\Http\Controllers;

use App\Models\Cadres;
use App\Models\Department;
use App\Models\Designation;
use App\User;
use Illuminate\Http\Request;

class CadresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->usertype == "department_admin") {
            $cadres = Cadres::where('dep_id', auth()->user()->dep_id)->get();
            return view('cadres.index', compact('cadres'));
        } else {
            $cadres = Cadres::all();
            return view('cadres.index', compact('cadres'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = null;
        $deps = null;
        if (auth()->user()->usertype == "department_admin") {
            $designations = Designation::where('dep_id', auth()->user()->dep_id)->get();
            $deps = Department::where('id', auth()->user()->dep_id)->get();
        }
        if (auth()->user()->usertype == "admin") {
            $designations = Designation::all();
            $deps = Department::all();
        }
        return view('cadres.create', compact('designations', 'deps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designation = implode(", ", $request->included_designation);
        $request->merge(['included_designation' => $designation]);
        $cadres = Cadres::create($request->all());
        session()->flash('message', 'Cadres included designation successfully added.');
        return redirect()->route('cadres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cadres $cadres
     * @return \Illuminate\Http\Response
     */
    public function show(Cadres $cadres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cadres $cadres
     * @return \Illuminate\Http\Response
     */
    public function edit(Cadres $cadre)
    {

        if (auth()->user()->usertype == "department_admin") {
            $designations = Designation::where('dep_id', auth()->user()->dep_id)->get();
            $inc_desig = explode(", ", $cadre->included_designation);
            return view('cadres.edit', compact('designations', 'cadre', 'inc_desig'));
        }
        if (auth()->user()->usertype == "admin") {
            $designations = Designation::all();
            $inc_desig = explode(", ", $cadre->included_designation);
            return view('cadres.edit', compact('designations', 'cadre', 'inc_desig'));
        }

        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cadres $cadres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cadres $cadre)
    {
        $designation = implode(", ", $request->included_designation);
        $request->merge(['included_designation' => $designation]);
        $cadres = $cadre->update($request->all());
        session()->flash('message', 'Cadres information successfully updated.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cadres $cadres
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cadres $cadre)
    {
        $cadre->delete();
        session()->flash('message', 'Record deleted successfully.');
        return redirect()->route('cadres.index');
    }
}
