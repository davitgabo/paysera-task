<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function updateUser($data)
    {
        Auth::user()->update($data);
        return Auth::user();
    }

    public function updatePassword($data)
    {
        $user = Auth::user();
        if (!Hash::check($data['old_password'], $user->password)) {
            return false;
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return true;
    }
}
