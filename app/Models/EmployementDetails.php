<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class EmployementDetails extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $fillable = ['employee_id', 'emp_status', 'designation', 'bps', 'time_scale', 'time_scale_date', 'appointment_date',
        'join_date', 'gross_salary','image','verified','selection_psc_date'];


    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
