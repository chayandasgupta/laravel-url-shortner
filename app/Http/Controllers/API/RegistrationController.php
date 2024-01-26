<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserAuthenticationRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserAuthenticationRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json(['user' => $user]);
    }
}
