<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallPerformances extends Model
{
    protected $fillable = [
        'student_id',
        'performance'
    ];
    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

}
