<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class TeachingDetail extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];
    protected $fillable = ['number','subject','class','periods','verified'];

    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
}
