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
        'time' => 'datetime:H:i',
    ];

    public function getTimeAttribute($value)
{
    return \Carbon\Carbon::createFromFormat('H:i', $value);
}
}
