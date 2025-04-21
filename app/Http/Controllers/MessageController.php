<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;
use App\Services\MessageService;

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
