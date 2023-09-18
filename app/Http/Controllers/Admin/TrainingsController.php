<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingsController extends Controller
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

        /*if ($employees->dep_id == 4) {
            return view('admin.teaching_details')->with([
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        } else {
            return view('admin.trainings')->with([
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }*/


        return view('admin.trainings')->with([
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
        if (isset($request->title)) {
            for ($count = 0; $count < count($request->title); $count++) {
                if (!empty($request->title[$count])) {
                    if (isset($request->qid[$count]) && $request->qid[$count] > 0) {
                        $training = Training::find($request->qid[$count]);
                        $training->title = $request->title[$count];
                        $training->start_date = $request->start_date[$count];
                        $training->end_date = $request->end_date[$count];
                        $training->country = $request->country[$count];
                        $training->national = $request->national[$count];
                        $training->type = $request->type[$count];
                        $training->place = $request->place[$count];
                        $training->institute = $request->institute[$count];
                        $training->funded_by = $request->funded_by[$count];
                        $training->employee_id = $emp_id;
                        $filename = null;
                        if ($request->hasFile('filelogo')) {
                            $file = $request->file('filelogo');
                            $name = $file[$count]->getClientOriginalName();
                            if ($request->root() == "http://127.0.0.1:8000") {
                                $destination = base_path() . '/public/uploads/training';
                            } else {
                                $destination = 'uploads' . '/training';
                            }
                            $filename = time() . '_' . auth()->id() . '_' . $name;
                            $file[$count]->move($destination, $filename);
                            $training->degree_image = $filename;
                        }
                        $training->update();
                    } else {
                        $training = new Training();
                        $training->title = $request->title[$count];
                        $training->start_date = $request->start_date[$count];
                        $training->end_date = $request->end_date[$count];
                        $training->country = $request->country[$count];
                        $training->national = $request->national[$count];
                        $training->type = $request->type[$count];
                        $training->place = $request->place[$count];
                        $training->institute = $request->institute[$count];
                        $training->funded_by = $request->funded_by[$count];
                        $training->employee_id = $emp_id;
                        $filename = null;
                        if ($request->hasFile('filelogo')) {
                            $file = $request->file('filelogo');
                            if (isset($file[$count])) {
                                $name = $file[$count]->getClientOriginalName();
                                if ($request->root() == "http://127.0.0.1:8000") {
                                    $destination = base_path() . '/public/uploads/training';
                                } else {
                                    $destination = 'uploads' . '/training';
                                }
                                $filename = time() . '_' . auth()->id() . '_' . $name;
                                $file[$count]->move($destination, $filename);
                                $training->degree_image = $filename;
                            }
                        }
                        $training->save();
                    }

                }
            }
        }
        $emp_detail = User::where('id', '=', $emp_id)->first();
        if ($request->submit == 'Save') {
            return redirect()->back()->with([
                'success' => 'Added Successfully',
            ]);
        }

		if ($emp_detail['dep_id'] == 4) {
            return redirect('teaching_details/' . $emp_id)->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        } else {

            return redirect('promotion_history/' . $emp_id)->with([
                'success' => 'Added Successfully',
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }

		/*if ($emp_detail['dep_id'] == 4) {
            return view('admin.teaching_details')->with([
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        } else {
            return redirect('/edit-promotion-history/' . $emp_id)->with([
                'employee_id' => $emp_id,
                'employee' => $employees
            ]);
        }*/


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $emp_id, Training $trainings)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
         return view('trainings.edit', compact('trainings','employees'));
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
    public function update(Request $request, $emp_id, Training $trainings)
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
                $destination = base_path() . '/public/uploads/training';
            } else {
                $destination = 'uploads' . '/training';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['degree_image' => $filename]);
        }

        $trainings->update($request->all());
        return back()->with('success', 'Training details has been updated...');
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
        $employee = Training::findOrFail($id);
        $request->merge(['verified' => 1]);
        $employee->update($request->all());
        session()->flash('message', 'Information successfully verified.');
        return redirect()->back();
    }
}
