<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Experience extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $table='experiences';
    protected $fillable = ['job_title', 'company_name', 'description', 'start_date',
        'end_date', 'continued','verified'];

    //relation with employee
    private $job_title;
    private $company_name;
    private $description;
    private $start_date;
    private $end_date;
    private $continued;
    private $employee_id;

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
