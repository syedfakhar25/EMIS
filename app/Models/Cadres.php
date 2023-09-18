<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadres extends Model
{
    use HasFactory;

    protected $fillable = ['dep_id','name','included_designation'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }
}
