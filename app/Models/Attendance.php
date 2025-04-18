<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'teaching_assignment_id',
        'status',
        'date'
    ];
    public function students(){
        return $this->hasMany(User::class, 'student_id');
    }
}
