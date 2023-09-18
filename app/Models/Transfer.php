<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Transfer extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $fillable = ['employee_id', 'from_department_id', 'to_department_id', 'stay', 'order_no','verified', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    //with department
    public function from_department()
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    //with department
    public function to_department()
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }
}
