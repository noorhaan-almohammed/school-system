<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\message;
use Illuminate\Http\Request;
use App\Services\MessageService;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    protected MessageService $MessageService;
    public function __construct(MessageService $MessageService)
    {
    $this->MessageService = $MessageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Message = $this->MessageService->sendMessage($request->validated());
        return self::success(null, 'Message Sent Successfully',201);
    }
    public function getNewMessages(User $reciever)
    {
        $message = $this->MessageService->getNewMessages($reciever);
        return self::success(new MessageResource($message), 'Message Retrieved Successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(message $message)
    {
        //
    }
}
