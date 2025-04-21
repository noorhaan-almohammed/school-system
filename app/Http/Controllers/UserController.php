<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Auth\UsererService;
use App\Http\Requests\Auth\UpdateUser;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    protected UsererService $UsererService;

    public function __construct(UsererService $UsererService)
    {
        $this->UsererService = $UsererService;
    }
    /**
     * create user with role depends on the form
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(RegisterRequest $request)
    {
        $data = $request->validated();
        $msg = $this->UsererService->createUser($data);
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
       return $this->UsererService->updateUser($data,$id);
    }

    public function deleteUser($id)
    {
        return $this->UsererService->deleteUser($id);
    }
}
