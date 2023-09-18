<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Transfer;
use App\User;
use Illuminate\Http\Request;

class TransferHistoryController extends Controller
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
        $department = Department::all();
        return view('admin.transfer_history')->with([
            'department' => $department,
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
        if (isset($request->from_department_id)) {
            for ($count = 0; $count < count($request->from_department_id); $count++) {
                if (!empty($request->from_department_id[$count]) && !empty($request->to_department_id[$count])) {
                    $transfer = new Transfer();
                    $transfer->from_department_id = $request->from_department_id[$count];
                    $transfer->to_department_id = $request->to_department_id[$count];
                    $transfer->date = $request->date[$count];
                    $transfer->stay = $request->stay[$count];
                    $transfer->order_no = $request->order_no[$count];
                    $transfer->employee_id = $emp_id;
                    $transfer->save();
                }
            }
        }
        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        } else {
            return redirect('employee_profile/' . $emp_id)->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }
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
    public function edit(Request $request, Transfer $transfer_history)
    {
        $emp_id = $transfer_history->employee_id;

        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $department = Department::all();
        return view('transferHistory.edit', compact('transfer_history','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer_history)
    {
        $emp_id = $transfer_history->employee_id;

        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $transfer_history->update($request->all());
        return redirect()->back()->with('success', 'Transfer details has been updated...');
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
        $employee = Transfer::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
