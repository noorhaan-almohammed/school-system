<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    protected $fillable = [
        'parent_id',
        'student_id'
    ];
    // Get the parent associated with a student.
    public function parent(){
        return $this->belongsTo(User::class, 'parent_id');
    }
    // Get the child associated with a parent.
    public function child(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
