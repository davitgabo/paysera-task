<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request);

        return response()->json($response, $response['status'] === 'success' ? 200 : 401);
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request);

        return response()->json($response);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        return response()->json($response);
    }

    public function refresh()
    {
        $response = $this->authService->refresh();

        return response()->json($response);
    }
}

