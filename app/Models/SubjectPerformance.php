<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectPerformance extends Model
{
    protected $fillable = [
        'student_id',
        'teaching_assignment_id',
        'grad',
        'comment'
    ];
    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

}
