<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'student_id',
        'total_amount',
        'paid_amount',
        'date',
    ];
    protected $casts = [
        'total_amount'=>'decimal:2',
        'paid_amount'=>'decimal:2',
        'date'=>'date',
    ];
    public function student(){
        return $this->belongsTo(User::class , 'student_id');
    }
}
