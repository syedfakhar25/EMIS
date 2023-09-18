<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class ResultHistory extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $fillable = ['number', 'subject', 'class', 'year', 'percentage_board', 'percentage_college', 'percentage_individual','verified'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
