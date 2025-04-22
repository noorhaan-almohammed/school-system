<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;
use App\Http\Requests\Auth\UpdateUser;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    protected UserService $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }
    /**
     * create user with role depends on the form
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $msg = $this->UserService->createUser($data);
        return redirect()->back()->with('success', $msg);
    }
    /**
     * show user by $id
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    /**
     * update user info
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateUser(UpdateUser $request, $id)
    {
       $data = $request->validated();
       return $this->UserService->updateUser($data,$id);
    }

    public function deleteUser($id)
    {
        return $this->UserService->deleteUser($id);
    }
}
