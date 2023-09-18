<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfessionalQualification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessionalQualificationController extends Controller
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
        return view('admin.professional_qualification')->with([
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
                    if (isset($request->qid[$count]) && $request->qid[$count] > 0) {
                        $qualification = ProfessionalQualification::find($request->qid[$count]);
                        $qualification->degree_name = $request->degree_name[$count];
                        $qualification->year = $request->year[$count];
                        $qualification->institute = $request->institute[$count];
                        $qualification->place_of_degree = $request->place_of_degree[$count];
                        $qualification->subject = $request->subject[$count];
                        $qualification->grade = $request->grade[$count];
                        $qualification->employee_id = $emp_id;
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
                        $qualification->update();

                    } else {
                        $qualification = new ProfessionalQualification;
                        $qualification->degree_name = $request->degree_name[$count];
                        $qualification->year = $request->year[$count];
                        $qualification->institute = $request->institute[$count];
                        $qualification->place_of_degree = $request->place_of_degree[$count];
                        $qualification->subject = $request->subject[$count];
                        $qualification->grade = $request->grade[$count];
                        $qualification->employee_id = $emp_id;
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
        }

        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        }
        else
        {
            return redirect('trainings/'.$emp_id.'/edit')->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }


//        return view('admin.edit-trainings')->with([
//            'employee_id' => $emp_id,
//            'employee' => $employees
//        ]);

//
//        return view('admin.trainings')->with([
//            'success' => 'Added Successfully',
//            'employee_id' => $emp_id,
//            'employee' => $employees
//        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $emp_id, ProfessionalQualification $professionalQualification)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('professional_qualification.edit', compact('professionalQualification'));
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $emp_id, ProfessionalQualification $professionalQualification)
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
            $professionalQualification->degree_image = $filename;
        }

        $professionalQualification->update($request->all());
        return back()->with('success', 'Professional qualification details has been updated...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public function verify(Request $request, $id)
    {
        $employee = ProfessionalQualification::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
