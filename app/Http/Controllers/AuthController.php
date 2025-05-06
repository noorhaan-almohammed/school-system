<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;


class AuthController extends Controller
{
    /**
     * The service class handling authentication logic.
     *
     * @var \App\Services\AuthService
     */
    protected $authService;

    /**
     * Inject AuthService to handle authentication-related logic.
     *
     * @param \App\Services\AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        // Assign AuthService instance to the controller
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        // Use AuthService to handle registration logic
        // The request data is filtered to include only necessary fields
        $result = $this->authService->register($request->only('name', 'email', 'password'));

        // Return a success response with user details and authentication token
        return $this->success(
            [
                'user' => $result['user'],
                'token' => $result['token']
            ],
            'User registered successfully'
        );
    }
    public function login(LoginRequest $request)
    {
        // Use AuthService to handle login logic
        // The request data is filtered to include only email and password
        $result = $this->authService->login($request->only('email', 'password'));

        // If login fails, return an error response with HTTP 401 status
        if (!$result) {
            return $this->error('Invalid credentials', 401);
        }

        // Return a success response with user details and authentication token
        return $this->success(
            [
                'user' => $result['user'],
                'token' => $result['token']
            ],
            'User logged in successfully'
        );
    }

    /**
     * Logout the authenticated user.
     *
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout the authenticated user",
     *     description="Revokes the user's token and logs them out",
     *     security={{"Bearer":{}}},
     *     @OA\Response(response=200, description="User logged out successfully"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     *
     * @return \Illuminate\Http\JsonResponse JSON response confirming successful logout
     */
    public function logout(Request $request)
    {
        // Use AuthService to handle logout by revoking user's tokens
        $this->authService->logout( $request);

        // Return a success response indicating the user has been logged out
        return $this->success(null, 'User logged out successfully');
    }
}
