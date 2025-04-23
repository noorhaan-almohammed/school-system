<?php

namespace App\Services;

use App\Models\message;
use Illuminate\Support\Facades\Auth;

class MessageService
{

public function sendMessage($data)
{
    $data['Sender_id'] = Auth::id();
    $Message = message::create($data);
    return $Message;
}
public function getNewMessages($reciever)
{
    $messages = $reciever->receivedMessages()->orderBy('created_at', 'desc')->paginate(10);
    return $messages;
}
}
