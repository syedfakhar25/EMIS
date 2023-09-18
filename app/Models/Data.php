<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['personal_no','first_name','cnic','ddo_code','cost_center','scale','payroll_area','designation','des_id','is_gazetted','birth_date','appointment_date','employee_group','fund','dep_id','father_first_name','gender','marital_status','age_of_employee','district_domicile',];
}
