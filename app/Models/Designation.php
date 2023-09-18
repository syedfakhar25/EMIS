<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    use \RecursiveRelationships\Traits\HasRecursiveRelationships;

    protected $fillable = ['dep_id', 'parent_id', 'designation_name'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }


    public function subcategory()
    {
        return $this->hasMany(Designation::class, 'parent_id')->orderBy('designation_name', 'asc');
    }


}
