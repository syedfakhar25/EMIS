<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Promotion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionHistoryController extends Controller
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

        return view('admin.promotion_history')->with([
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


        if (isset($request->promotion)) {
            for ($count = 0; $count < count($request->promotion); $count++) {
                if (!empty($request->promotion[$count])) {
                    $promotion = new Promotion();
                    $promotion->pro_ind_upgrad = $request->pro_ind_upgrad[$count];
                    $promotion->promotion = $request->promotion[$count];
                    $promotion->designation = $request->designation[$count];
                    $promotion->selection_date = $request->selection_date[$count];
                    $promotion->date = $request->date[$count];
                    $promotion->order_no = $request->order_no[$count];
                    $promotion->time_scale = $request->time_scale[$count];
                    $promotion->employee_id = $emp_id;
                    $promotion->save();
                    User::where('id',$emp_id)->update(['designation'=>$request->designation[$count], 'time_scale' => $request->time_scale[$count]]);
                }
            }
        }

		if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        } else {
            $department = Department::all();
            return redirect('transfer_history/' . $emp_id )->with([
                'success' => 'Added Successfully',
                'department' => $department,
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
    public function edit(Request $request, Promotion $promotionHistory)
    {
        $emp_id = $promotionHistory->employee_id;

        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        return view('promotionHistory.edit',compact('promotionHistory','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotionHistory)
    {
        $emp_id = $promotionHistory->employee_id;

        $employees = User::find($emp_id);
        if(!User::hasAccess($employees))
        {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $promotionHistory->update($request->all());
        User::where('id',$emp_id)->update(['designation'=>$request->designation,  'time_scale' => $request->time_scale]);
        return redirect()->back()->with('success', 'Promotion details has been updated...');
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
        $employee = Promotion::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
