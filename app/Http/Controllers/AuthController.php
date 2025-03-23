<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\Response;
use App\Services\CRUD\UserCRUDService;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function __construct(protected JWTAuth $jwtAuthService, protected UserCRUDService $userService)
    {
    }

    public function login(LoginRequest $request)
    {
        $token = $this->jwtAuthService->attempt($request->validated());

        if (!$token) {
            throw new InvalidCredentialsException();
        }

        return new Response(['token' => $token]);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return new Response(['token' => $this->jwtAuthService->fromUser($user)]);
    }
}
