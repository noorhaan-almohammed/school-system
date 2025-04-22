<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
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
        'time'=>'time',
        'duration'=>'integer'
    ];
}
