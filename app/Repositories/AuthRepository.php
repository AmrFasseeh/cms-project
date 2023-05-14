<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * @param $userInput
     * @return bool
     */
    public function loginUser($userInput): bool
    {
        return Auth::attempt($userInput);
    }

    /**
     * @param User $user
     * @return int
     */
    public function logoutUser(User $user): int
    {
        return $user->tokens()->delete();
    }
}
