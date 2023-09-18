<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class SubDepartment extends Model
{
    use HasFactory, Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];
    protected $fillable = ['dep_id', 'name'];

    public function subcategory()
    {
        return $this->hasMany(Department::class, 'parent_id')->orderBy('dep_name', 'asc');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

}
