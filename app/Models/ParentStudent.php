<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    protected $fillable = [
        'parent_id',
        'student_id'
    ];
}
