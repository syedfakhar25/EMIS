<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeachingDetailController extends Controller
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
        return view('admin.teaching_details')->with([
            'employee_id' => $emp_id,
            'employee' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $emp_id)
    {
        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('admin.teaching_details')->with([
            'employee_id' => $emp_id,
            'employee' => $employees
        ]);
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
            'subject' => 'required',
            'subject.*' => 'required',
        ]);

        if (isset($request->number)) {
            for ($count = 0; $count < count($request->number); $count++) {
                if (!empty($request->number[$count])) {
                    $t_details = new TeachingDetail();
                    $t_details->number = $request->number[$count];
                    $t_details->subject = $request->subject[$count];
                    $t_details->class = $request->class[$count];
                    $t_details->periods = $request->periods[$count];
                    $t_details->employee_id = $emp_id;
                    $t_details->save();
                }
            }
        }
		
        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        } else {
            return redirect('result_history/' . $emp_id)->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }
		/*
        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        }
        if (Auth::user()->usertype == 'user') {
            if (Auth::user()->employee_id != $emp_id) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!'
                ]);
            }
        }
        return view('edit.edit-result_history')->with([
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TeachingDetail $teachingDetail)
    {

        $emp_id = $teachingDetail->employee_id;

        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('teaching.edit',compact('teachingDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeachingDetail $teachingDetail)
    {
        $emp_id = $teachingDetail->employee_id;
        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $this->validate($request, [
            'subject' => 'required',
            'subject.*' => 'required',
        ]);
        $teachingDetail->update($request->all());
        return redirect()->back()->with('success', 'Teaching details has been updated...');

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
}
