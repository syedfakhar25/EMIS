<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class ProfessionalQualification extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];


    public $fillable = ['employee_id', 'degree_name', 'year', 'institute', 'subject', 'grade','verified','place_of_degree'];

    public function User()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
