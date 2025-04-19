<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class parent_student extends Model
{
    protected $fillable = [
        'parent_id',
        'student_id'
    ];
}
