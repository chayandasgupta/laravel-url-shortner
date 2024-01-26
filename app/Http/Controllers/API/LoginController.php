<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\UserAuthenticationRequest;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserAuthenticationRequest $request)
    {
        $credentials = $request->validated();
        $token = $this->userService->loginUser($credentials);

        if ($token) {
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' =>  $token
            ], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
