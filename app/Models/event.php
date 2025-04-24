<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'time',
        'duration',
        'description'
    ];
    protected  $casts = [
        'date'=>'date',
        'duration'=>'integer',
    ];

    public function getTimeAttribute($value)
    {
        return \Carbon\Carbon::parse($value);
    }

}
