<?php

use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('auth.login');
    }

});
Route::get('reset-password', 'Admin\DashboardController@resetPassword')->name('reset-password');
Route::put('update-password', 'Admin\DashboardController@updatePassword')->name('update-password');

Route::get('/mail', function () {
    Mail::to("alirazamarchal@hotmail.com")->send(new \App\Mail\WelcomeMail());
    return new \App\Mail\WelcomeMail();
});


Auth::routes(['verify' => true]);
/*Route::group(['middleware' => ['auth', 'user']], function (){

});*/
Route::auth();
// Routes for Admin Panel
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');;
    Route::get('/home', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/markAsRead', 'Admin\DashboardController@markAsRead')->name('markRead');

    Route::get('/employees', 'Admin\DashboardController@allUsers')->name('employees');
    Route::get('/employees/{id}/edit', 'Admin\DashboardController@edit')->name('employees.edit');
    Route::put('/employees/{id}', 'Admin\DashboardController@update');
    Route::get('/employees/{id}/verify', 'Admin\DashboardController@VerifyUser');

    Route::get('/employee_profile/{id}', 'Admin\DashboardController@ViewEmployee');
    Route::resource('departments', 'Admin\DepartmentController');
    #####################################################
    Route::get('/employement-details/{id}/edit', 'Admin\EmployementDetailsController@index');
    Route::post('/employement-details/{id}', 'Admin\EmployementDetailsController@store');
    Route::get('/employement-details/{emp_id}/{employementDetails}', 'Admin\EmployementDetailsController@show');
    Route::put('/employement-details/{emp_id}/{employementDetails}', 'Admin\EmployementDetailsController@update');
    #####################################################

    Route::get('/qualifications/{id}/edit', 'Admin\QualificationController@index');
    Route::post('/qualifications/{id}', 'Admin\QualificationController@store');
    Route::get('/qualifications/{emp_id}/{qualification}', 'Admin\QualificationController@show');
    Route::put('/qualifications/{emp_id}/{qualification}', 'Admin\QualificationController@update');
    Route::delete('qualifications/{qualification}', 'Admin\QualificationController@destroy')->name('qualifications.destroy');
    #####################################################

    Route::get('/professional_qualifications/{id}/edit', 'Admin\ProfessionalQualificationController@index');
    Route::post('/professional_qualifications/{id}', 'Admin\ProfessionalQualificationController@store');
    Route::get('/professional_qualifications/{emp_id}/{professionalQualification}', 'Admin\ProfessionalQualificationController@show');
    Route::put('/professional_qualifications/{emp_id}/{professionalQualification}', 'Admin\ProfessionalQualificationController@update');

    #####################################################
    Route::get('/trainings/{id}/edit', 'Admin\TrainingsController@index');
    Route::post('/trainings/{id}', 'Admin\TrainingsController@store');
    Route::get('/trainings/{emp_id}/{trainings}', 'Admin\TrainingsController@show');
    Route::put('/trainings/{emp_id}/{trainings}', 'Admin\TrainingsController@update');
    #####################################################

    ##################################################### (Best Example For Resource)
    Route::get('/teaching_details/{id}/create', 'Admin\TeachingDetailController@create');
    Route::get('/teaching_details/{id}', 'Admin\TeachingDetailController@index');
    Route::get('/teaching_details/{teachingDetail}/edit', 'Admin\TeachingDetailController@edit');
    Route::put('/teaching_details/{teachingDetail}', 'Admin\TeachingDetailController@update');
    Route::post('/teaching_details/{teachingDetail}', 'Admin\TeachingDetailController@store');
    #####################################################

    #####################################################
    Route::get('/result_history/{id}/create', 'Admin\ResultHistoryController@create');
    Route::get('/result_history/{id}', 'Admin\ResultHistoryController@index');
    Route::post('/result_history/{id}', 'Admin\ResultHistoryController@store');
    Route::get('/result_history/{resultHistory}/edit', 'Admin\ResultHistoryController@edit');
    Route::put('/result_history/{resultHistory}', 'Admin\ResultHistoryController@update');
    #####################################################


    #####################################################
    Route::get('/promotion_history/{id}', 'Admin\PromotionHistoryController@index');
    Route::post('/promotion_history/{id}', 'Admin\PromotionHistoryController@store');
    Route::get('/promotion_history/{id}/create', 'Admin\PromotionHistoryController@create');
    Route::get('/promotion_history/{promotion_history}/edit', 'Admin\PromotionHistoryController@edit');
    Route::put('/promotion_history/{promotion_history}', 'Admin\PromotionHistoryController@update');
    #####################################################


    #####################################################
    Route::get('/transfer_history/{id}', 'Admin\TransferHistoryController@index');
    Route::post('/transfer_history/{id}', 'Admin\TransferHistoryController@store');
    Route::get('/transfer_history/{id}/create', 'Admin\TransferHistoryController@create');
    Route::get('/transfer_history/{transfer_history}/edit', 'Admin\TransferHistoryController@edit');
    Route::put('/transfer_history/{transfer_history}', 'Admin\TransferHistoryController@update');
    #####################################################

    #####################################################
    //verification
    Route::get('/employee_verify/{id}', 'Admin\EmployementDetailsController@verify');
    Route::get('/qualifications/{id}', 'Admin\QualificationController@verify');
    Route::get('/professional_qualifications/{id}', 'Admin\ProfessionalQualificationController@verify');
    Route::get('/trainings/{id}', 'Admin\TrainingsController@verify');
    // Route::get('/teaching_details/{id}', 'Admin\TeachingDetailController@verify');
    // Route::get('/result_history/{id}', 'Admin\ResultHistoryController@verify');
    // Route::get('/promotion_history/{id}', 'Admin\PromotionHistoryController@verify');
    // Route::get('/transfer_history/{id}', 'Admin\TransferHistoryController@verify');

    #####################################################
    //    Route::get('/report/departmentFocalPerson', 'Admin\DashboardController@departmentFocalPerson');
    #####################################################


    #####################################################
    Route::get('/register/admin', 'Admin\DashboardController@registerAdmin');
    Route::post('/register/admin', 'Admin\DashboardController@registerAdminSubmit')->name('registerAdmin');
    #####################################################

    #####################################################
    Route::get('/reports', 'ReportController@designationWise')->name('report.designationWise');
    Route::get('/reports/districtwise', 'ReportController@districtWise')->name('report.districtWise');
    Route::get('/reports/district', 'ReportController@district')->name('report.district');
    Route::get('/reports/cadres', 'ReportController@cadres')->name('report.cadres');

    #####################################################

    #####################################################
    Route::resource('cadres', 'CadresController');
    #####################################################

    #####################################################
    Route::resource('designation', 'DesignationController');
    Route::resource('sub-departments', 'SubDepartmentController');
    #####################################################


    #####################################################
    Route::get('acrPartOne/{user}/create', 'AcrPartOneController@create')->name('acrPartOne.create');
    Route::post('acrPartOne', 'AcrPartOneController@store')->name('acrPartOne.store');
    Route::get('acrView/{acrPartOne}', 'AcrPartOneController@show')->name('acrPartOne.show');
    #####################################################

});

Route::get('/get-designation-by-department', 'Admin\DashboardController@getDesignationByDepartment')->name('getDesignationByDepartment');
//Route::resource('data', 'DataController');

Auth::routes(
    [
        'register' => 'Admin\DashboardController@index',
    ]
);


Route::get('/run-script', function () {

    // get unique


/*
    $designations = \App\Models\Designation::whereIn('designation_name',[
        'Head constabel',
        'Head Constable',
        'Head Constable 03',
        'Head Constable 202',
        'Head Constable 52 District Muzaffarabad',
        'Head constable nmbr 1335',
        'Head Constable No 04',
        'Head constable no 102',
        'Head Constable No.11',
        'Head Constable No.181',
        'Head Constable No.285',
        'Head Constable No.311',
        'Headconstabl',
        'Headconstable',
        'H C',
        'H c 13',
        'H.C',
        'H.C944',
        'Hc constable',
        'HC-881',
        'HC873',
    ])->where('dep_id',5)->where('id','!=',19)->get();


    foreach($designations as $des)
    {
        $user = User::where('designation',$des->id)->where('dep_id',5)->get();
        foreach($user as $usr)
        {
            $usr->designation = 19;
            $usr->save();
        }
    }

    foreach($designations as $des)
    {
        $des->delete();
    }

    dd('done');

    /*
    ini_set('max_execution_time', 600);
//    $users = User::where('dep_id', 5)->get();
    $users = User::whereNotNull('designation')->get();
    $designations = \App\Models\Designation::whereNotNull('designation_name')->pluck('designation_name')->toArray();
    $designations = array_map('strtolower', $designations);
    $o1 = '';
    $o2 = '';
    foreach ($users as $user) {
        $x = trim($user->designation);
        if (!empty($x) && !in_array(strtolower($x), $designations) && !is_numeric($x)) {
            $designation = new \App\Models\Designation();
            $designation->designation_name = $x;
            $designation->dep_id = $user->dep_id;
            $designation->parent_id = 0;
            $designation->save();
            $user->designation = $designation->id;
            $user->save();
            $designations[] = strtolower($x);
            $o1 .= $x . ', ';
//            dd($designation);
        } elseif (!empty($x) && !is_numeric($x)) {

            $designation_x = \App\Models\Designation::where('designation_name', $x)->whereNotNull('designation_name')->first();
            if (!empty($designation_x))
            {
                $user->designation = $designation_x->id;
                $user->save();
            }

            $o2 .= $x . ', ';

        }
    }

    return $o1 . '<br><br><br><br>' . $o2;
*/
});



