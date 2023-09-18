<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcrTraining extends Model
{
    use HasFactory;

    protected $fillable = ['acr_part_one_id', 'subject', 'institute', 'country', 'from', 'to',];
}
