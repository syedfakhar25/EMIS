<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResultHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultHistoryController extends Controller
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
        return view('admin.result_history')->with([
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
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('admin.result_history')->with([
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
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        if (isset($request->number)) {
            for ($count = 0; $count < count($request->number); $count++) {
                if (!empty($request->number[$count])) {
                    $result_history = new ResultHistory();
                    $result_history->number = $request->number[$count];
                    $result_history->subject = $request->subject[$count];
                    $result_history->class = $request->class[$count];
                    $result_history->year = $request->year[$count];
                    $result_history->percentage_board = $request->percentage_board[$count];
                    $result_history->percentage_college = $request->percentage_college[$count];
                    $result_history->percentage_individual = $request->percentage_individual[$count];
                    $result_history->employee_id = $emp_id;
                    $result_history->save();
                }
            }
        }
        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        } else {
            return redirect('promotion_history/' . $emp_id . '/edit')->with([
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
    public function edit(Request $request, ResultHistory $resultHistory)
    {
        $emp_id = $resultHistory->employee_id;

        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('result.edit',compact('resultHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultHistory $resultHistory)
    {

        $emp_id = $resultHistory->employee_id;
        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $resultHistory->update($request->all());
        return redirect()->back()->with('success', 'Result history details has been updated...');
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
