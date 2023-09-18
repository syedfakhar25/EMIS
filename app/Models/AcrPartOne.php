<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcrPartOne extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','department_id','from','to','name','personal_no','dob','date_of_joining',
        'post_held_during_period_with_bps','academic_qualification','knowledge_of_languages_speaking_reading_writing',
        'post_served','in_present_post','under_the_reporting_officer_name','under_the_reporting_officer_cnic'];


    public function acr_trainings()
    {
        return $this->hasMany(AcrTraining::class);
    }


    public function acr_trainings_part_two()
    {
        return $this->hasOne(AcrPartTwo::class);
    }
}
