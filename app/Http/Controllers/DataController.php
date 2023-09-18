<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Department;
use App\Models\Designation;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//1169
        //UPDATE users set district_domicile = "Muzaffarabad" where district_domicile in ('MZD','MZ','MUZAFFARAZBAD')
        ini_set('max_execution_time', 600);
        $dataList = Data::where('id', '>=', 70000)->where('id', '<=', 80000)->get();
        //dd($dataList);
        $total_records_processed = 0;
        $new_des_created = 0;

        /*
       $userList = \App\User::pluck('cnic')->toArray();
       $cnic_without_dash = [];
       foreach ($userList as $data) {
           $cnic_without_dash[] = str_replace("-", "", $data);
       }

         */
        $count = 0;
        $count2 = 0;
        $count3 = 1;

        // designation works with unique
//        $designations = $dataList->pluck('designation')->unique()->toArray();

        // get designation from designations
//        $designation_data = Designation::where('dep_id', 5)->pluck('designation_name')->toArray();
//        $match = 0;
//        $to_be_inserted = [];
//        foreach ($designations as $de) {
//            $flag = 0;
//            foreach ($designation_data as $des) {
//
//                if (strtolower($de) == strtolower($des)) {
//                    echo $de . " => " . $des . "<br>";
//                    $match++;
//                    $flag = 1;
//                }
//            }
//            if (!in_array($de, $to_be_inserted) && !$flag)
//                $to_be_inserted[] = $de;
//        }
//        dd($to_be_inserted);
//        foreach ($to_be_inserted as $des) {
//            $designation = new Designation();
//            $designation->dep_id = 94;
//            $designation->parent_id = 0;
//            $designation->designation_name = $des;
//            $designation->save();
//        }

//        dd($to_be_inserted);


//        foreach ($designations as $des) {
//            $designation = new Designation();
//            $designation->dep_id = 94;
//            $designation->parent_id = 0;
//            $designation->designation_name = $des;
//            $designation->save();
//        }

//        $des = Designation::where('dep_id', 5)->pluck('designation_name', 'id')->toArray();

        foreach ($dataList as $data) {


            /*     $designation = $data->designation;
                 $dep_id = $data->dep_id;
                 $designation_check = Designation::where('dep_id', $dep_id)->where('designation_name', $designation)->pluck('id')->first();
                 if($designation_check == null)
                 {
                     $designation_check = Designation::create([
                         'dep_id'=>$dep_id,
                         'designation_name'=>$designation,
                         'parent_id'=>0
                     ]);
                     $designation_check = $designation_check->id;
                     $new_des_created++;
                 }
             $total_records_processed ++;
             $data->update([
                 'des_id'=>$designation_check
             ]);*/


            $cnic_formated = null;
            if (strlen($data->cnic) == 13) {
                $first_five = substr($data->cnic, 0, 5);
                $second_five = substr($data->cnic, 5, 7);
                $last_one = substr($data->cnic, 12, 1);
                $cnic_formated = $first_five . "-" . $second_five . "-" . $last_one;
            } else {
                $cnic_formated = $data->cnic;
            }

            // check if exist then update
            $user_check = \App\User::where('cnic', $cnic_formated)->first();


            if (!empty($user_check)) {
                $user_check->personal_no = $data->prsonal_no;
                $user_check->cnic = $cnic_formated;
                $user_check->birth_date = $data->birth_date;
                $user_check->appointment_date = $data->appointment_date;
                $user_check->district_domicile = $data->district_domicile;
                $user_check->save();
            }


            $count++;

            /*
            if (empty($user_check)) {
                $user = new \App\User();
                $user->dep_id = $data->dep_id;
                $user->personal_no = $data->personal_no;
                $user->cnic = $cnic_formated;

                $user->first_name = $data->first_name;
                $user->middle_name = null;
                $user->last_name = null;
                $user->father_first_name = $data->father_first_name;
                $user->father_middle_name = null;
                $user->father_last_name = null;
                $user->ddo_code = $data->ddo_code;
                $user->cost_center = $data->cost_center;
                $user->scale = $data->scale;
                $user->payroll_area = $data->payroll_area;
//                $user->position = $data->position;
                $user->birth_date = $data->birth_date;
                $user->appointment_date = $data->appointment_date;

                $user->designation = $data->des_id;
                $user->is_gazetted = $data->is_gazetted;

                $user->fund = $data->fund;
                $user->gender = $data->gender;
                $user->marital_status = $data->marital_status;
                $user->district_domicile = $data->district_domicile;
                $user->emp_type = 'permanent';
                $user->verified = 1;
                $user->verified_by = 109;
                $user->password = '$2y$10$wbMNJADfeSQ95IvOQqapc.s96LHoszUEsT36k4kGBXLmQxFRGzi6C';
                $user->save();

                $dep = Department::find($user->dep_id);
                $short_name = $dep->short_name;
                $code = $user->id;
                $emis_code = 'AJKEMIS' . '-' . $short_name . '-' . $code;
                $user->emis_code = $emis_code;
                $user->save();
                $count++;
            } else {
                $user_check->dep_id = $data->dep_id;
                $user_check->cnic = $cnic_formated;

                $user_check->first_name = $data->first_name;
                $user_check->ddo_code = $data->ddo_code;
                $user_check->cost_center = $data->cost_center;
                $user_check->payroll_area = $data->payroll_area;
//                $user_check->position = $data->position;
                $user_check->fund = $data->fund;
                $user_check->gender = $data->gender;
                $user_check->marital_status = $data->marital_status;

                $user_check->middle_name = null;
                $user_check->last_name = null;
                $user_check->father_first_name = $data->father_first_name;
                $user_check->father_middle_name = null;
                $user_check->father_last_name = null;
                $user_check->scale = $data->scale;

                $user_check->designation = $data->des_id;
                $user_check->emp_type = 'permanent';
                $user_check->verified = 1;
                $user_check->verified_by = 109;
                //03008169924
                $user_check->password = '$2y$10$wbMNJADfeSQ95IvOQqapc.s96LHoszUEsT36k4kGBXLmQxFRGzi6C';
                $user_check->save();

                $dep = Department::find($user_check->dep_id);
                $short_name = $dep->short_name;
                $code = $user_check->id;
                $emis_code = 'AJKEMIS' . '-' . $short_name . '-' . $code;
                $user_check->emis_code = $emis_code;
                $user_check->save();
                $count2++;
            }
*/
        }


        dd($count . ' ' . $count2);
        //dd('Total = '.$total_records_processed.' New = '.$new_des_created);

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
     * @param \App\Models\Data $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Data $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Data $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Data $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Data $data)
    {
        //
    }
}
