<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UpdateUser;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * public information for any user
     * show user by $id
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function showUser($id)
    {
        try{
            $user = User::findOrFail($id);
            return $this->success($user);
        }catch(ModelNotFoundException){
            return $this->error(null, "Not found",404 );
        }catch(Exception){
            return $this->error();
        }
    }
    /**
     * student information
     * show User With Subject And Class
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function showUserWithSubjectAndClass($id)
    {
        return $this->UserService->showUserWithSubjectAndClass($id);
    }
    /**
     * Summary of showUserInfoBacedOnRole
     * @param \GuzzleHttp\Psr7\Request $request
     * @return void
     */
    public function showUserInfoBacedOnRole(Request $request){
        /**
         * @var User
         */
        $user = Auth::user();
        $user_role = $user->getRoleNames()->first();
        $userInfo = $this->UserService->showUserInfo($user_role,$user->id);
        return $userInfo;
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
        return $this->UserService->updateUser($data, $id);
    }
    /**
     * delete User
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        return $this->UserService->deleteUser($id);
    }
}
