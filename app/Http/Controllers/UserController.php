<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class UserController extends Controller
{
    protected RegisterService $RegisterService;

    public function __construct(RegisterService $RegisterService)
    {
        $this->RegisterService = $RegisterService;
    }
    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $msg = $this->RegisterService->createUser($data);
        return redirect()->back()->with('success', $msg);
    }
}
