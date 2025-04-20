<?php

namespace App\Services;

use App\Models\User;
use App\Models\message;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class MessageService
{

public function sendMessage($data)
{
    $data['Sender_id'] = Auth::id();
    $Message = message::create($data);
    return $Message;
}
}
