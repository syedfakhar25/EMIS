<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcrPartTwo extends Model
{
    use HasFactory;

    protected $fillable = ['acr_part_one_id', 'user_id', 'job_description', 'brief_account_achievements'];
}
