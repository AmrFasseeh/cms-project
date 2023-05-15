<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function loginUser($userInput): bool
    {
        return Auth::attempt($userInput);
    }

    public function logoutUser(User $user): int
    {
        return $user->tokens()->delete();
    }
}
