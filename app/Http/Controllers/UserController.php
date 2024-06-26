<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api');

        $this->userService = $userService;
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $response = $this->userService->updateUser($request->validated());

        return response()->json(UserResource::make($response));
    }

    public function UpdatePassword(UpdatePasswordRequest $request)
    {
        if ($this->userService->updatePassword($request->validated())){
            return response()->json(['message' => 'Password changed successfully.']);
        } else {
            return response()->json(['error' => 'The provided old password does not match.'], 400);
        }
    }
}
