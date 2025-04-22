<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name'
    ];
    public function teachers(){
        return $this->belongsToMany(User::class ,'teaching_assignments','class_id','teacher_id');
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class,'teaching_assignments','class_id','subject_id');
    }
    public function students(){
        return $this->hasMany(User::class, 'class_id');
    }
}
