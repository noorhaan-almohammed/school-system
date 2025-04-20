<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Auth\RegisterService;
use App\Http\Requests\Auth\RegisterRequest;

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
