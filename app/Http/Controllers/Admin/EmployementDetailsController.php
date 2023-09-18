<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployementDetails;
use App\User;
use Illuminate\Http\Request;

class EmployementDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $emp_id)
    {
        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }


        return view('admin.employement-details')->with([
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
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $this->validate($request, [
            'emp_status' => 'required',
            'emp_status.*' => 'required',
        ]);

        if (isset($request->emp_status)) {
            for ($count = 0; $count < count($request->emp_status); $count++) {
                if (!empty($request->emp_status[$count])) {
                    $employment_details = new EmployementDetails();
                    $employment_details->emp_status = $request->emp_status[$count];
                    $employment_details->designation = $request->designation[$count];
                    $employment_details->bps = $request->bps[$count];
                    $employment_details->time_scale = $request->time_scale[$count];
                    $employment_details->time_scale_date = $request->time_scale_date[$count];
                    $employment_details->appointment_date = $request->appointment_date[$count];
                    $employment_details->join_date = $request->join_date[$count];
                    $employment_details->gross_salary = $request->gross_salary[$count];
                    $employment_details->employee_id = $emp_id;

                    $filename = null;
                    if ($request->hasFile('filelogo')) {
                        $file = $request->file('filelogo');
                        if (isset($file[$count])){
                            $name = $file[$count]->getClientOriginalName();
                            if ($request->root() == "http://127.0.0.1:8000") {
                                $destination = base_path() . '/public/uploads/employee';
                            } else {
                                $destination = 'uploads'  . '/employee';
                            }
                            $filename = time() . '_' . auth()->id() . '_' . $name;
                            $file[$count]->move($destination, $filename);
                            $employment_details->image = $filename;
                        }

                    }

                    $employment_details->save();
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
            return redirect('qualifications/'.$emp_id.'/edit')->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }

        /*return view('admin.employeeQualification')->with([
            'success' => 'Employment details added successfully.',
            'employee_id' => $emp_id,
            'employee' => $employees
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $emp_id, EmployementDetails $employementDetails)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }


        return view('employment.edit', compact('employementDetails','employees'));
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
    public function update(Request $request,  $emp_id, EmployementDetails $employementDetails)
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
            $request->merge(['image' => $filename]);
        }

        $employementDetails->update($request->all());
        return back()->with('success', 'Employment details has been updated...');
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

        $employee = EmployementDetails::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
