<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectPerformance extends Model
{
    protected $fillable = [
        'student_id',
        'teaching_assignment_id',
        'grade',
        'comment'
    ];
    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
    public function teachingAssignment()
    {
        return $this->belongsTo(TeachingAssignment::class, 'teaching_assignment_id');
    }
}
