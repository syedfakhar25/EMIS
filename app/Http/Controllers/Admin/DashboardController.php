<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcrPartOne;
use App\Models\Cadres;
use App\Models\Department;
use App\Models\Designation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function allUsers(Request $request)
    {
        $users = new User();
        $user_type = Auth::user()->usertype;
        if ($user_type == 'user') {
            $employees = User::findOrFail(Auth::user()->id);
            if (!User::hasAccess($employees)) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!',
                ]);
            }
        }
        if (
            $request->has('emp_type') || $request->has('department') || $request->has('verified') || $request->has('dep_id')
            || $request->has('name') || $request->has('emis_code') || $request->has('cnic') || $request->has('phone')
            || $request->has('gender') || $request->has('marital_status') || $request->has('refugee_status')
            || $request->has('province_domicile') || $request->has('district_domicile') || $request->has('age')
            || $request->has('last_24hrs') || $request->has('designation') || $request->has('ddo_code')|| $request->has('scale')
            || $request->has('scale_greater') || $request->has('scale_less')
        ) {

//            if ($request->input('age')) {
//                $arr = explode('-', str_replace(' ', '', $request->age));
//                $to = Carbon::today();
//                $previous_year = Carbon::today();
//                $from = $previous_year->subYear($arr[1]);
//                $from_format = $from->format('Y-m-d');
//                $to_format = $to->format('Y-m-d');
//                $users->where(function ($query) use($from_format,$to_format){
//                    $query->whereBetween('birth_date', [$from_format, $to_format]);
//                });
////                $users = $users->whereBetween('birth_date', [$from_format, $to_format]);
//            }

            if ($request->input('name')) {
                $users = $users->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', "%$request->name%")
                        ->orWhere('middle_name', 'like', "%$request->name%")
                        ->orWhere('last_name', 'like', "%$request->name%");
                });
            }

            if ($user_type == 'department_admin') {
                $users = $users->where('dep_id', Auth::user()->dep_id);
            }

            if ($request->input('emis_code')) {
                $users = $users->where('emis_code', $request->emis_code);
            }

            if ($request->input('ddo_code')) {
                $users = $users->where('ddo_code', $request->ddo_code);
            }

            if ($request->input('scale')) {
                $users = $users->where('scale', $request->scale);
            }
            if ($request->input('scale_greater')) {
                $scale = intval( $request->scale_greater);
                $users = $users->where('scale', '>', $scale);
            }

            if ($request->input('scale_less')) {
                $users = $users->where('scale', '<=', $request->scale_less);
            }

            if ($request->input('cost_center')) {
                $users = $users->where('cost_center', $request->cost_center);
            }
            if ($request->input('personal_no')) {
                $users = $users->where('personal_no', $request->personal_no);
            }
            if ($request->input('cnic')) {
                $users = $users->where('cnic', $request->cnic)->orWhere('cnic', str_replace("-", "", $request->cnic));
            }
            if ($request->input('personal_no')) {
                $users = $users->where('personal_no', $request->personal_no);
            }
            if ($request->input('phone')) {
                $users = $users->where('residential_phone', $request->phone)
                    ->orWhere('office_phone', 'like', "%$request->phone%")
                    ->orWhere('mobile_phone', 'like', "%$request->phone%")
                    ->orWhere('fax_number', 'like', "%$request->phone%");
            }
            if ($request->input('gender')) {
                $users = $users->whereIn('gender', $request->gender);
            }
            if ($request->input('marital_status')) {
                $users = $users->whereIn('marital_status', $request->marital_status);
            }
            if ($request->input('refugee_status')) {
                $users = $users->whereIn('refugee_status', $request->refugee_status);
            }

            if ($request->input('emp_type')) {
                if (in_array("NotSet", $request->emp_type)) {
                    $users = $users->where(function ($query) {
                        $query->where('emp_type', '=', '')->orWhereNull('emp_type');
                    });
                } else {
                    $users = $users->whereIn('emp_type', $request->emp_type);
                }
            }


            if ($request->input('province_domicile')) {
                $users = $users->whereIn('province_domicile', $request->province_domicile);
            }
            if ($request->input('district_domicile')) {
                $did = $request->input('district_domicile');
                if (empty($did[0])) {
                    $users = $users->where(function ($query) {
                        $query->where('district_domicile', '=', '')->orWhereNull('district_domicile');
                    });
                } else {
                    $users = $users->whereIn('district_domicile', $request->district_domicile);
                }
            }
            if (isset($request->verified)) {
                $users = $users->whereIn('verified', $request->verified);
            }


            if ($user_type != 'department_admin') {
                if ($request->input('dep_id')) {
                    $users = $users->whereIn('dep_id', $request->dep_id);
                }
            }
            if ($request->input('last_24hrs')) {
                if ($request->last_24hrs[0] == '24hr') {
                    $users = $users->where('dep_id', Auth::user()->dep_id)->where("created_at", ">", \Carbon\Carbon::now()->subDay())->where("created_at", "<", \Carbon\Carbon::now());
                } else {
                    $users = $users->where("created_at", ">", \Carbon\Carbon::now()->subDay())->where("created_at", "<", \Carbon\Carbon::now());
                }
            }

            if ($request->input('designation')) {
//                dd($request->all());
                if (in_array("NotSet", $request->designation)) {
                    $users = $users->where(function ($query) {
                        $query->where('designation', '=', '')->orWhereNull('designation');
                    });
                } else {
                    $users = $users->whereIn('designation', $request->designation);
                }
            }


            // if ($request->input('district')) {
            //     $users = $users->where('district', urldecode($request->district));
            // }

            $users = $users->paginate(20);


        } else {
            if ($user_type == 'department_admin') {
                $users = User::where('dep_id', Auth::user()->dep_id)->paginate(20);
            } else {
                $users = User::orderBy('created_at', 'desc')->paginate(20);
            }
        }


        $dept = Department::all();

//        dd(\App\User::where('dep_id',auth()->user()->dep_id)->groupBy('designation')->get());
        return view('user.index', compact('users', 'dept'));

    }

    public function edit(Request $request, $emp_id)
    {
        $employees = User::findOrFail($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!',
            ]);
        }

        $descendents = Department::find($employees->dep_id)->descendents();
        $check_sub_department = $descendents->isNotEmpty();
        return view('user.edit', compact('employees', 'check_sub_department', 'descendents'));
    }

    public function update(Request $request, $emp_id)
    {
        $employees = User::findOrFail($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!',
            ]);
        }
        if (isset($request->department_id_change)) {
            $dep = Department::find($request->department_id_change);
            $short_name = $dep->short_name;
            $emis_code = 'AJKEMIS' . '-' . $short_name . '-' . $employees->id;
            $employees->emis_code = $emis_code;
            $employees->dep_id = $request->department_id_change;
            $employees->save();
        }
        $filename = null;
           if ($request->hasFile('emp_img')) {
            $path = $request->file('emp_img')->store('uploads/employee','public');
            $request->merge(['image' => $path]);
               
           }
        if ($request->filled('district_domicile')) {
            $x = explode(':', $request->district_domicile);
            $request->merge(['province_domicile' => $x[0]]);
            $request->merge(['district_domicile' => $x[1]]);
        }

        if ($request->filled('pwd')) {
            $request->merge(['password' => Hash::make($request->pwd)]);
        }

        $employees->update($request->all());
        if ($request->submit == "Save") {
            return back()->with('message', 'Employee details has been updated...');
        } elseif ($request->submit == "Next") {
            return redirect('employement-details/' . $emp_id . '/edit')->with('message', 'Employee details has been updated...');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $user_employee_dep = $user->dep_id;
        $employees = new User();
        $depEmp = '';
        $total_emp = 0;
        $not_set = 0;
        $total_dep = 0;
        $not_verified_users = 0;
        $verified_users = 0;
        $data = [];
        $employment_count = 0;
        $academic_count = 0;
        $professional_count = 0;
        $trainings_count = 0;
        $transfer_count = 0;
        $teaching_details_count = 0;
        $result_history_count = 0;
        $promotion_count = 0;
        $cadre = null;

        if (Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin') {
            if (Auth::user()->usertype == 'admin') {
                $total_dep = Department::where('parent_id', 0)->count();
                $not_verified_users = User::where('verified', '=', 0)
                    ->count();
                $verified_users = User::where('verified', '=', 1)->count();
                $depEmp = $employees->selectRaw('users.emp_type , count(*) AS total')
                    ->groupBy('users.emp_type')
                    ->get();
            } elseif (Auth::user()->usertype == 'department_admin') {

                $not_verified_users = User::where('verified', '=', 0)->where('dep_id', '=', $user_employee_dep)->count();
                $verified_users = User::where('verified', '=', 1)->where('dep_id', '=', $user_employee_dep)->count();

                $depEmp = $employees->selectRaw('users.emp_type , count(*) AS total')
                    ->where('users.dep_id', '=', $user_employee_dep)
                    ->groupBy('users.emp_type')
                    ->get();


                $designation = Cadres::where('dep_id', auth()->user()->dep_id)->get();

                $cadre = [];
                foreach ($designation as $des) {
                    $cadre[$des->name] = explode(', ', $des->included_designation);
                    $cadre[$des->name] = (!empty(DB::table('users')->select('dep_id', DB::raw('count(*) as total'))->whereIn('designation', $cadre[$des->name])->where('dep_id', auth()->user()->dep_id)->groupBy('dep_id')->first())) ? DB::table('users')->select('dep_id', DB::raw('count(*) as total'))->whereIn('designation', $cadre[$des->name])->where('dep_id', auth()->user()->dep_id)->groupBy('dep_id')->first()->total : 0;
                }

            }
            $total_emp = 0;
            $data = [
                'notSet' => 0,
                'permanent' => 0,
                'adhoc' => 0,
                'deputation' => 0,
                'contract' => 0,
                'temporary' => 0,
                'internee' => 0,
                'retired' => 0,
                'work_charge' => 0,
                'contingent_paid' => 0,

            ];

            foreach ($depEmp as $de) {
                if (empty($de['emp_type'])) {
                    $data['notSet'] += $de['total'];
                    /*$de['emp_type'] = 'notSet';*/

                } else {
                    $data[$de['emp_type']] += $de['total'];
                }
                $total_emp+= $de['total'];
            }

            //$total_emp = $data['adhoc'] + $data['notSet'] + $data['Active Permanent'] + $data['Active Temporary'] + $data['Parliamentarians'] + $data['Regular / Contract'] + $data['Retiree/pensioner'] + $data['Vocational Permanent'] + $data['Vocational Temporary'];
            $gender_wise_graph = 0;
            $retirment_in = 0;
            $age_gorup_in = 0;
            $scale_wise = 0;
            $department_wise_chart = 0;
            $designation_wise_chart = 0;

            // get gender wise data
            if (auth()->user()->usertype == 'department_admin') {
                $gender_wise_data = DB::table('users')
                    ->select('gender', DB::raw('count(gender) AS total'))
                    ->where('users.dep_id', auth()->user()->dep_id)
                    ->groupBy('gender')
                    ->get();
            } elseif(auth()->user()->usertype == 'admin')
            {
                $gender_wise_data = DB::table('users')
                    ->select('gender', DB::raw('count(gender) AS total'))
                    ->groupBy('gender')
                    ->get();
            }



            $gender_wise_graph = [];
            $gender_count = 0;
            foreach ($gender_wise_data as $gender) {
                if (!empty($gender->gender)) {
                    $gender_wise_graph[$gender->gender] = $gender->total;
                } else {
                    $gender_count += $gender->total;
                }
            }


            $gender_wise_graph['Not Set'] = $gender_count;
            //$age_group = $results = DB::select("SELECT t.age_group, COUNT(*) AS age_count FROM (SELECT CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 30 THEN '15-30' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 31 AND 40 THEN '31-40' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 41 AND 50 THEN '41-50' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60 THEN '51-60' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60 THEN '60+' ELSE 'Unknown (Not Set)' END AS age_group FROM users) as t GROUP BY t.age_group");
            //$age_retirement = $results = DB::select("SELECT t.age_group, COUNT(*) AS retirement_count FROM ( SELECT CASE WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 55 AND 56 THEN '55-56 Years' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 57 AND 58 THEN '57-58 Years' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 59 AND 60 THEN '59-60 Years' WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60 THEN '60+ Years' ELSE 'Other' END AS age_group FROM users ) t GROUP BY t.age_group;");

            if (auth()->user()->usertype == 'department_admin') {
                $age_gorup_in = [
                    'Up to 21 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-15 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-21 year')))->count(),
                    '22 to 30 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-22 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-30 year')))->count(),
                    '31 to 40 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-31 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-40 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '41 to 50 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-41 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-50 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '51 to 60 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-51 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-60 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '60 to 65 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-60 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-65 year')))->where('users.dep_id', auth()->user()->dep_id)->count()
                ];
            }
            else
            {
                $age_gorup_in = [
                    'Up to 21 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-15 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-21 year')))->count(),
                    '22 to 30 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-22 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-30 year')))->count(),
                    '31 to 40 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-31 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-40 year')))->count(),
                    '41 to 50 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-41 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-50 year')))->count(),
                    '51 to 60 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-51 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-60 year')))->count(),
                    '60 to 65 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-60 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-65 year')))->count()
                ];
            }


            if (auth()->user()->usertype == 'department_admin') {
                $retirment_in = [
                    '1 year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-59 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-60 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '2 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-58 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-59 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '3 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-57 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-58 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '4 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-56 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-57 year')))->where('users.dep_id', auth()->user()->dep_id)->count(),
                    '5 Years'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-55 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-56 year')))->where('users.dep_id', auth()->user()->dep_id)->count()
                ];
            } else
            {
                $retirment_in = [
                    '1st year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-59 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-60 year')))->count(),
                    '2nd Year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-58 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-59 year')))->count(),
                    '3rd Year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-57 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-58 year')))->count(),
                    '4th Year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-56 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-57 year')))->count(),
                    '5th Year'=>User::where('birth_date','<=',date('Y-m-d', strtotime('-55 year')))->where('birth_date','>=',date('Y-m-d', strtotime('-56 year')))->count()
                ];

            }



            if (auth()->user()->usertype == 'department_admin') {
                $scale_wise = DB::select("SELECT `scale`, COUNT(scale) AS total FROM `users` WHERE `scale` IS NOT NULL and users.dep_id = " . auth()->user()->dep_id ." GROUP BY `scale` ORDER BY `scale`+0 ASC;");
            } else
            {
                $scale_wise = DB::select("SELECT `scale`, COUNT(scale) AS total FROM `users` WHERE `scale` IS NOT NULL GROUP BY `scale` ORDER BY `scale`+0 ASC;");
            }


            if (auth()->user()->usertype == 'department_admin') {
                $department_wise_chart = DB::table('users')
                    ->leftJoin('departments', 'departments.id', '=', 'users.dep_id')
                    ->select(DB::raw('upper(departments.dep_name) as name'), DB::raw('COUNT(dep_id) AS total'))
                    ->where('users.dep_id', auth()->user()->dep_id)
                    ->orderBy('departments.dep_name', 'ASC')
                    ->groupBy('dep_id')
                    ->get();

            }
            else {
                $department_wise_chart = DB::table('users')
                    ->leftJoin('departments', 'departments.id', '=', 'users.dep_id')
                    ->select(DB::raw('upper(departments.dep_name) as name'), DB::raw('COUNT(dep_id) AS total'))
                    ->orderBy('departments.dep_name', 'ASC')
                    ->groupBy('dep_id')
                    ->get();

//            dd($department_wise_chart);
            }

            if (auth()->user()->usertype == 'department_admin')
            {
                $designation_wise_chart = DB::table('users')
                    ->Join('designations','designations.id','=','users.designation')
                    ->Join('departments','departments.id','=','users.dep_id')
                    ->where('users.dep_id', auth()->user()->dep_id)
                    ->select('departments.dep_name','designations.designation_name',DB::raw('COUNT(designations.designation_name) AS total'))
                    ->orderBy('departments.dep_name','ASC')
                    ->groupBy('users.designation')
                    ->get();
            } else
            {
                DB::enableQueryLog();
                $designation_wise_chart = DB::table('users')
                    ->Join('departments','departments.id','=','users.dep_id')
                    ->select('departments.dep_name','users.designation',DB::raw('COUNT(users.designation) AS total'))
                    ->orderBy('departments.dep_name','ASC')
                    ->groupBy('users.designation','users.dep_id')
                    ->get();
            }


        } else {
            $employment_count = $user->EmployementDetails->count();
            $academic_count = $user->qualification->count();
            $professional_count = $user->professional_qualification->count();
            $trainings_count = $user->trainings->count();
            $transfer_count = $user->transfer->count();
            $teaching_details_count = $user->teaching_details->count();
            $result_history_count = $user->result_history->count();
            $promotion_count = $user->promotion->count();
            $gender_wise_graph = 0;
            $retirment_in = 0;
            $age_gorup_in=0;
            $scale_wise=0;
            $department_wise_chart=0;
            $designation_wise_chart=0;
        }



        return view('admin.dashboard')->with(
            [
                'cadre' => $cadre,
                'total_dep' => $total_dep,
                'total_emp' => $total_emp,
                'data' => $data,
                'not_verified_users' => $not_verified_users,
                'verified_users' => $verified_users,

                'employment_count' => $employment_count,
                'academic_count' => $academic_count,
                'professional_count' => $professional_count,
                'trainings_count' => $trainings_count,
                'teaching_details_count' => $teaching_details_count,
                'result_history_count' => $result_history_count,
                'transfer_count' => $transfer_count,
                'promotion_count' => $promotion_count,

                'gender_wise_graph' => $gender_wise_graph,
                'age_retirement' => $retirment_in,
                'age_gorup_in' => $age_gorup_in,
                'scale_wise' => $scale_wise,
                'department_wise_chart' => $department_wise_chart,
                'designation_wise_chart' => $designation_wise_chart,
            ]
        );
    }

    public function ViewEmployee($emp_id)
    {
        $employees = User::find($emp_id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!',
            ]);
        }


        $acr_bps_ninteen_above = AcrPartOne::where('user_id', $emp_id)->orderBy('from', 'DESC')->get();
//        dd($acr_bps_ninteen_above);
//        dd($employees->promotion->last());
        return view('admin.employee-profile', compact('employees', 'acr_bps_ninteen_above'));
    }

    public function VerifyUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = 1;
        $user->verified_by = auth()->user()->id;
        $user->update();
        return redirect()->back()->with('success', 'Employee has been verified.');
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function departmentFocalPerson(Request $request)
    {
        $focalPerson = DB::table('departments')->join('users', 'departments.id', '=', 'users.dep_id')->select('departments.id as dep_id', 'departments.dep_name', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.personal_no', 'users.email', 'users.id as user_id')->where('users.usertype', 'department_admin')->get();
        return view('departmentFocalPerson.index', compact('focalPerson'));
    }

    public function registerAdmin()
    {
        if (Auth::user()->usertype == 'user') {
            session()->flash('message', 'You are not authorized to view page');
            return redirect('dashboard');
        } elseif (Auth()->user()->usertype == "department_admin" || Auth()->user()->usertype == "admin") {
            return view('admin.adminRegister');
        }
    }

    // register custom user
    protected function validator(array $data)
    {
        if (empty($data['email'])) {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                //            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        } else {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        }
    }

    public function registerAdminSubmit(Request $data)
    {

        if (empty($data['email'])) {
            $validated = $data->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'mobile_phone' => ['required'],
                'emp_type' => ['required'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        } else {
            $validated = $data->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'mobile_phone' => ['required'],
                'emp_type' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        }

        $data = $data->all();
        $x = explode(':', $data['district_domicile']);
        $user_id = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'mobile_phone' => $data['mobile_phone'],
            'emp_type' => $data['emp_type'],
            'cnic' => $data['cnic'],
            'designation' => $data['designation'],
            'province_domicile' => $x[0],
            'district_domicile' => $x[1],
            'email' => $data['email'],
            'dep_id' => $data['dep_id'],
            'verified' => 1,
            'verified_by' => auth()->user()->id,
            'usertype' => $data['usertype'],
            'password' => Hash::make($data['password']),
        ]);
        $dep = Department::find($data['dep_id']);
        $short_name = $dep->short_name;
        $code = $user_id->id + 1000;
        $emis_code = 'AJKEMIS' . '-' . $short_name . '-' . $code;
        $user_id->update([
            'emis_code' => $emis_code,
        ]);
        session()->flash('success', 'User successfully added.');
        return redirect('employees?cnic=' . $user_id->cnic);
    }


    public function get_sub_designation($dep_id, $parent_id = 0, $indent = '')
    {
        $des_tree = '';

        $parent_designations = Designation::where('parent_id', $parent_id)->where('dep_id', $dep_id)->orderBy('designation_name', 'asc')->get();
        if ($parent_designations->isNotEmpty()) {
            foreach ($parent_designations as $des) {
                $des_tree .= '<option value="' . $des->id . '">' . $indent . $des->designation_name . '</option>';

                $des_tree .= $this->get_sub_designation($dep_id, $des->id, $indent . '&nbsp;&nbsp;&nbsp;');
            }
        }
        return $des_tree;

    }

    public function getDesignationByDepartment(Request $request)
    {
        $parent_designations = '<option>No Designation Found</option>';
        if ($request->has('dep_id') && $request->dep_id > 0) {
            $parent_designations = $this->get_sub_designation($request->dep_id, 0, '');
        }
        return $parent_designations;
    }

    //custom reset password
    public function resetPassword(){
        return view('auth.passwords.password_custom');
    }

    public function updatePassword(Request $request){
        $cnic = $request->cnic;
        $user = User::where('cnic', $cnic)->first();
        //dd($user);
        if($user == NULL)
        {
            return redirect()->back()->with('status', 'No user exists with this cnic');
        }
        else{
            $user->password = Hash::make($request->password);
            $user->update();
            return redirect()->route('login')->with('status', 'Password Updated ');
        }

    }
}
