<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = [
        'name',
        'date'
    ];
    protected  $casts = [
        'date'=>'date'
    ];
}
