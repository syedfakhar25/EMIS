<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Promotion extends Model
{
    //
    use Notifiable, LogsActivity;

    protected static $logAttributes = ['*'];

    protected $fillable = ['promotion', 'selection_date', 'designation', 'date', 'order_no', 'employee_id', 'pro_ind_upgrad','time_scale'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
