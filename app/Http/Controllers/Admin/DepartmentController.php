<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cadres;
use App\Models\Department;
use App\Models\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $parent_designations = Department::where('parent_id', 0)->orderBy('dep_name', 'asc')->get();

        $departments = Department::leftJoin('users', function ($join) {
            $join->on('departments.id', '=', 'users.dep_id');
        })->select(
            'departments.id',
            'departments.dep_name',
            'departments.logo',
            DB::raw('count(users.id) as totalEmployees')
        )
            ->groupBy('departments.id', 'departments.dep_name', 'departments.logo')
            ->get();
        $focal_person = array();

//        foreach ($departments as $dep) {
//            $user = User::where('dep_id', $dep->id)->where('users.usertype', 'department_admin')->first();
//            if ($user)
//                $focal_person[$dep->id] = $user;
//        }


        $fp_list = User::where('users.usertype', 'department_admin')->get();
//        dd($fp_list->where('dep_id',1)->first());
        $total = count($departments);

        return view('department.index', compact('focal_person', 'total', 'departments', 'parent_designations', 'fp_list'));
    }

    public function store(Request $request)
    {

        $filename = null;
        if ($request->hasFile('filelogo')) {
            $file = $request->file('filelogo');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/department';
            } else {
                $destination = 'uploads' . '/department';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['logo' => $filename]);
        }
        Department::create($request->all());
        $all_dep = Department::all();
        $total = Department::count();
        return redirect()->back()->with([
            'success' => 'Added Successfully',
            'department' => $all_dep,
            'total' => $total,
        ]);
    }

    public function edit(Request $request, Department $department)
    {
        return view('department.edit', compact('department'));
    }


    public function update(Request $request, Department $department)
    {
        $filename = null;
        if ($request->hasFile('filelogo')) {
            $file = $request->file('filelogo');
            $name = $file->getClientOriginalName();
            if ($request->root() == "http://127.0.0.1:8000") {
                $destination = base_path() . '/public/uploads/department';
            } else {
                $destination = 'uploads' . '/department';
            }
            $filename = time() . '_' . auth()->id() . '_' . $name;
            $file->move($destination, $filename);
            $request->merge(['logo' => $filename]);
        }
        $department->update($request->all());
        return redirect()->back()->with('success', 'Department updated successfully.');
        //        return view('department.edit',compact('department'))->with(['success' =>'scnn']);
    }

    public function show(Request $request, Department $department)
    {
        $designation = Cadres::where('dep_id', $department->id)->get();
        $cadre = [];
        foreach ($designation as $des) {
            // $cadre[$des->name] = "'" . str_replace(', ', "','", $des->included_designation) . "'";
            $cadre[$des->name] = explode(', ', $des->included_designation);
            $cadre[$des->name] = DB::table('users')->select('dep_id', DB::raw('count(*) as total'))->whereIn('designation', $cadre[$des->name])->where('dep_id', $department->id)->groupBy('dep_id')->first()->total;
        }
        $empl = new User();
        $depEmp = $empl->selectRaw('users.emp_type , count(*) AS total')
            ->where('users.dep_id', '=', $department->id)
            ->groupBy('users.emp_type')
            ->get();

        $data = [
            'notSet' => 0,
            'permanent' => 0,
            'adhoc' => 0,
            'deputation' => 0,
            'contract' => 0,
            'emp_status' => 0,
            'temporary' => 0,
            'internee' => 0,
            'retired' => 0,
            'work_charge' => 0,
            'contingent_paid' => 0,

            'Active Permanent' => 0,
            'Active Temporary' => 0,
            'Parliamentarians' => 0,
            'Regular / Contract' => 0,
            'Retiree/pensioner' => 0,
            'Vocational Permanent' => 0,
            'Vocational Temporary' => 0,
        ];
        $total_emp = 0;

        foreach ($depEmp as $de) {
            if (empty($de['emp_type'])){
                $data['notSet'] = $data['notSet'] + $de['total'];
            }
            else{
                $data[$de['emp_type']] += $de['total'];
            }

            $total_emp+= $de['total'];
        }


//        $total_emp = $data['notSet'] + $data['permanent'] + $data['adhoc'] + $data['deputation'] + $data['contract'] + $data['temporary'] + $data['internee'];
        //$total_emp = $data['notSet'] + $data['Active Permanent'] + $data['Active Temporary'] + $data['Parliamentarians'] + $data['Regular / Contract'] + $data['Retiree/pensioner'] + $data['Vocational Permanent'] + $data['Vocational Temporary'];

        //        dd($depEmp);
        return view('department.show', compact(['department', 'data', 'total_emp', 'cadre']));
    }

    public function destroy(Request $request, Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
