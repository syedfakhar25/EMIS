<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Qualification extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $fillable = ['employee_id', 'qualification_level', 'start_date','end_date','national_foreign','city','degree_name','year','institute','subject','marks_percentage','grade','country','province','district','major_specialization','minor_spacialization','degree_status','source_of_funding','bond_details','degree_image','verified',];
    public function user(){
        return $this->belongsTo(User::class , 'employee_id');
    }

}
