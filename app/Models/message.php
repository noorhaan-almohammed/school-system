<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $fillable = [
        'Sender_id',
        'Recieve_id',
        'content'
    ] ;
    public function sender(){
        return $this->belongsTo(User::class, 'Sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class ,'Recieve_id');
    }
}
