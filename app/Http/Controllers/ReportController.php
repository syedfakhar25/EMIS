<?php

namespace App\Http\Controllers;

use App\Models\Cadres;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

    public function designationWise(Request $request)
    {
        $employees = User::findOrFail(auth()->user()->id);
        if (!User::hasAccess($employees)) {
            return redirect('/dashboard')->with([
                'success' => 'You are not authorized to view this page!'
            ]);
        }
        $users = new User();
        //SELECT designation, count(*) from users where dep_id = '13' GROUP by designation
        // DB::enableQueryLog();
        $users = $users->select(DB::raw('designation, count(*) as total'));
        if (auth()->user()->usertype == 'department_admin') {
            $users = $users->where('dep_id', Auth::user()->dep_id);
        } elseif (auth()->user()->usertype == 'admin') {
            if ($request->has('dep_id')) {
                $users = $users->whereIn('dep_id', $request->dep_id);
            }
        }



        if ($request->input('designation')) {

            if (auth()->user()->usertype == 'department_admin') {
                $did = $request->input('designation');
                if (empty($did[0])) {
                    $users = $users->where(function ($query) {
                        $query->where('designation', '=', '')->orWhereNull('designation');
                    })->where('dep_id', Auth::user()->dep_id);
                } else {
                    $users = $users->whereIn('designation', $request->designation)->where('dep_id', Auth::user()->dep_id);
                }

            } elseif (auth()->user()->usertype == 'admin') {

                $did = $request->input('designation');
                if (empty($did[0])) {
                    $users = $users->where(function ($query) {
                        $query->where('designation', '=', '')->orWhereNull('designation');
                    });
                } else {
                    $users = $users->whereIn('designation', $request->designation);
                }
            }



            // dd($request->all());

        }

        // $users = $users->where('dep_id', 13);

        $collection = DB::table('users')
            ->leftJoin('designations', 'users.designation', '=', 'designations.id')
            ->select( DB::raw('count(users.id) as total_users'), 'designations.designation_name')
            ->groupBy('designations.designation_name')->get();
        if(Auth::user()->usertype == 'department_admin'){
            $collection = DB::table('users')
                ->leftJoin('designations', 'users.designation', '=', 'designations.id')
                ->select( DB::raw('count(users.id) as total_users'), 'designations.designation_name')
                ->where('designations.dep_id', Auth::user()->dep_id)
                ->groupBy('designations.designation_name')->get();
        }


        // $collection = User::select(DB::raw('designation, count(*) as total'))->where('dep_id', '13')->groupBy('district')->get();
        // dd(DB::getQueryLog());
        // $collection = DB::table('users')->where('dep_id', '13')->select('designation', DB::raw('count(*) as total'))->groupBy('district')->get();
        return view('report.designationWise', compact('collection'));
    }

    public function districtWise(Request $request)
    {
        if ($request->has('designation')) {
            $employees = User::findOrFail(auth()->user()->id);
            if (!User::hasAccess($employees)) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!'
                ]);
            }
            $users = new User();
            if ($request->has('designation') || $request->has('dep_id')) {
                $users = $users->select(DB::raw('designation, district_domicile, count(*) as total'));
                if (auth()->user()->usertype == 'department_admin') {
                    if ($request->input('designation')) {
                        if ($request->designation == 'NotSet') {
                            $users = $users->where('dep_id', auth()->user()->dep_id)->where(function ($query) {
                                $query->where('designation', '=', '')->orWhereNull('designation');
                            });
                        } else {
                            $users = $users->where('designation', $request->designation)->where('dep_id', auth()->user()->dep_id);
                        }
                    }
                } elseif (auth()->user()->usertype == 'admin') {
                    if ($request->input('designation')) {
                        if ($request->designation == 'NotSet') {
                            $users = $users->where(function ($query) {
                                $query->where('designation', '=', '')->orWhereNull('designation');
                            });
                        } else {
                            $users = $users->where('designation', $request->designation);
                        }
                    }
                    if ($request->has('dep_id')) {
                        $users = $users->whereIn('dep_id', $request->dep_id);
                    }
                }
            }

            // DB::enableQueryLog();
            $collection = $users->groupBy('designation', 'district_domicile')->get();
            // dd(DB::getQueryLog());
            return view('report.districtWise', compact('collection'));
        }
    }

    public function district(Request $request)
    {

            $districts = [
                'Bagh',
                'Bhimber',
                'Haveli',
                'Jhelum Valley',
                'Kotli',
                'Mirpur',
                'Muzaffarabad',
                'Neelum',
                'Poonch',
                'Sudhnati',
                'Others',
            ];
            $employees = User::findOrFail(auth()->user()->id);
            if (!User::hasAccess($employees)) {
                return redirect('/dashboard')->with([
                    'success' => 'You are not authorized to view this page!'
                ]);
            }
            $users = new User();
            if ($request->has('dep_id')) {

                if (auth()->user()->usertype == 'department_admin') {
                    $users =  DB::table('users')
                        ->selectRaw('designations.designation_name, users.district_domicile, COUNT(designations.designation_name) AS total')
                        ->join('designations', 'users.designation', '=', 'designations.id')
                        ->where( 'users.dep_id' ,'=', $request->dep_id);
                } elseif (auth()->user()->usertype == 'admin') {
                    //
                }
            }

            $collection = $users->groupBy(['designations.designation_name','users.district_domicile'])->orderBy('designations.designation_name')->get();

            $data = [];
            foreach ($collection as $coll)
            {
                if (in_array($coll->district_domicile,$districts))
                    $data[$coll->designation_name][$coll->district_domicile] = $coll->total;
                else
                    if (isset($data[$coll->designation_name]['Others']))
                        $data[$coll->designation_name]['Others'] += $coll->total;
                    else
                        $data[$coll->designation_name]['Others'] = $coll->total;
            }

            return view('report.district', compact('collection','data','districts'));

    }

    public function cadres(Request $request)
    {
        $designation = Cadres::all('included_designation');
        $desgination_array = [];
        foreach ($designation as $des) {
            $desgination_array[] = $des->included_designation;
        }


        dd(implode(",",$desgination_array));
        return view('report.cadres');
    }
}
