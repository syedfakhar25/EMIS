<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
//use RecursiveRelationships\Traits\HasRecursiveRelationships;
class Department extends Model
{
    use Notifiable, LogsActivity;
    use \RecursiveRelationships\Traits\HasRecursiveRelationships;
    protected static $logAttributes = ['*'];

    protected $table = 'departments';
    protected $fillable = ['dep_name', 'short_name', 'logo', 'description', 'website_url','parent_id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function subDepartment()
    {
        return $this->hasMany(SubDepartment::class,'dep_id');
    }

    public function subDep()
    {
        return $this->belongsTo(Department::class,'parent_id');
    }

    //relation with transfers
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }

    public function subcategory()
    {
        return $this->hasMany(Department::class, 'parent_id')->orderBy('dep_name', 'asc');
    }
}
