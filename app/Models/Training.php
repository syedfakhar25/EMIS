<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Training extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];
    protected $fillable = ['title', 'start_date', 'end_date', 'national' ,'type', 'institute', 'place',
                             'country' ,'funded_by','degree_image','verified'];
    public function user(){
        return $this->belongsTo(User::class , 'employee_id');
    }
}
