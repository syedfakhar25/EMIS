<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $emp_id)
    {

        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }

//        if (Auth::user()->usertype == 'user') {
//            if (Auth::user()->id != $emp_id) {
//                return redirect('/dashboard')->with([
//                    'success' => 'You are not authorized to view this page!'
//                ]);
//            }
//        } elseif (Auth()->user()->usertype == "department_admin") {
//            if (Auth::user()->dep_id != $employees->dep_id) {
//                return redirect('/dashboard')->with([
//                    'success' => 'You are not authorized to view this page!'
//                ]);
//            }
//        }
        return view('admin.employeeQualification')->with([
            'employee_id' => $emp_id,
            'employee' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $emp_id)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }

        $this->validate($request, [
            'degree_name' => 'required',
            'degree_name.*' => 'required',
        ]);

        if (isset($request->degree_name)) {
            for ($count = 0; $count < count($request->degree_name); $count++) {
                if (!empty($request->degree_name[$count])) {
                    $qualification = new Qualification();
                    $qualification->degree_name = $request->degree_name[$count];
                    $qualification->qualification_level = $request->qualification_level[$count];
                    $qualification->year = $request->year[$count];
                    $qualification->institute = $request->institute[$count];
                    $qualification->subject = $request->subject[$count];
                    $qualification->marks_percentage = $request->marks_percentage[$count];
                    $qualification->grade = $request->grade[$count];
                    $qualification->country = $request->country[$count];
                    $qualification->province = $request->province[$count];
//                    $qualification->district = $request->district[$count];
                    $qualification->employee_id = $emp_id;

                    $qualification->start_date = $request->start_date[$count];
                    $qualification->end_date = $request->end_date[$count];
                    $qualification->national_foreign = $request->national_foreign[$count];
                    $qualification->city = $request->city[$count];
                    $qualification->major_specialization = $request->major_specialization[$count];
                    $qualification->minor_spacialization = $request->minor_spacialization[$count];
                    $qualification->degree_status = $request->degree_status[$count];
                    $qualification->source_of_funding = $request->source_of_funding[$count];
                    $qualification->bond_details = $request->bond_details[$count];

                    $filename = null;
                    if ($request->hasFile('filelogo')) {
                        $file = $request->file('filelogo');
                        if (isset($file[$count])) {
                            $name = $file[$count]->getClientOriginalName();
                            if ($request->root() == "http://127.0.0.1:8000") {
                                $destination = base_path() . '/public/uploads/employee';
                            } else {
                                $destination = 'uploads' . '/employee';
                            }
                            $filename = time() . '_' . auth()->id() . '_' . $name;
                            $file[$count]->move($destination, $filename);
                            $qualification->degree_image = $filename;
                        }
                    }
                    $qualification->save();
                }
            }

        }

        if ($request->submit == "Save") {
            return redirect()->back()->with([
                'success' => 'Added Successfully'
            ]);
        }
        else
        {
            return redirect('professional_qualifications/'.$emp_id.'/edit')->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }
    /*    return view('admin.professional_qualification')->with([
            'success' => 'Added Successfully',
            'employee_id' => $emp_id,
            'employee' => $employees
        ]);
	*/
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $emp_id, Qualification $qualification)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('qualification.edit', compact('qualification'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $emp_id, Qualification $qualification)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $filename = null;
        if ($request->hasFile('filelogo')) {
            $file = $request->file('filelogo');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/employee';
            } else {
                $destination = 'uploads' . '/employee';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['degree_image' => $filename]);
        }
        $qualification->update($request->all());
        return back()->with('success', 'Qualifications details has been updated...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qualification = Qualification::find($id);
        $qualification->delete();
        return back()->with('success', 'Qualifications details has been removed...');
    }

	public function verify(Request $request, $id)
    {
        $employee = Qualification::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
