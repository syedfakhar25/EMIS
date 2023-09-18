<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Notifications\PendingUser;
use App\Notifications\UserRegistration;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		if (empty($data['email'])) {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'mobile_phone' => ['required', 'string', 'max:255'],
                'emp_type' => ['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        } else {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'mobile_phone' => ['required', 'string', 'max:255'],
                'emp_type' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'dep_id' => ['required'],
                'cnic' => 'required|string|max:15|unique:users',
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

//        dd($data);

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
            'password' => Hash::make($data['password']),
        ]);
        $dep = Department::find($data['dep_id']);
        $short_name = $dep->short_name;
        $code = $user_id->id + 1000;
        $emis_code = 'AJKEMIS' . '-' . $short_name . '-' . $code;
        $user_id->update([
            'emis_code' => $emis_code
        ]);

        #send mail via notification
		$dep_admin = User::orWhere(function($q) use ($user_id) {
            $q->where('usertype', 'admin')->orWhere('usertype', 'department_admin');
        })->where('dep_id', $user_id->dep_id)->get();

        Notification::send($dep_admin, new UserRegistration($user_id));


        #send notification to admin via database notification
        $users = User::where('usertype', 'admin')->get();
        Notification::send($users, new PendingUser($user_id));
        return $user_id;


//        $dep_admin = User::where('dep_id', $user_id->dep_id)->where('usertype', 'department_admin')->orWhere('usertype', 'admin')->get();
        /*
		$dep_admin = User::where('usertype', 'admin')->orWhere(function ($query,$user_id) {
            $query->where('usertype', 'department_admin')->where('dep_id', $user_id->dep_id);
        })->get();
        Notification::send($dep_admin, new UserRegistration($user_id));
*/

        #send notification to admin via database notification
 /*
 		$users = User::where('usertype', 'admin')->get();
        Notification::send($users, new PendingUser($user_id));
        return $user_id;
*/

    }


}
