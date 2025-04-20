<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teaching_assignment extends Model
{
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
