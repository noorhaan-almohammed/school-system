<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teaching_assignment extends Model
{
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id'
    ];
}
