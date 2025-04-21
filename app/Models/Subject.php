<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function teachers(){
        return $this->belongsToMany(User::class,'teaching_assignments','subject_id','teacher_id');
    }
    public function classes(){
        return $this->belongsToMany(Classroom::class, 'teaching_assignments','subject_id','class_id');
    }
}
