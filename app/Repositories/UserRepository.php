<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function getAllUsers($role, $config)
    {
        return User::where('role', $role)
            ->paginate(
                perPage: $config['perPage'] ?? 12,
                page: $config['page'] ?? 1
            );
    }

    public function getUserById($id): User
    {
        return User::find($id);
    }

    public function getUserByRole($id, $role): User
    {
        return User::role($role)
            ->whereId($id)
            ->first();
    }

    public function getUserByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    public function createUser($inputs): User
    {
        return User::create([
            'name' => $inputs['name'],
            'username' => $inputs['username'],
            'phone' => $inputs['phone'],
            'email' => $inputs['email'],
            'password' => Hash::make($inputs['password']),
        ]);
    }

    public function updateUser($inputs, $role)
    {
        $user = $this->getUserByRole($inputs['id'], $role);

        $currentPassword = $user->getAuthPassword();

        if (isset($inputs['password']) && ! Hash::check($inputs['password'], $currentPassword)) {
            $currentPassword = Hash::make($inputs['password']);
        }

        $user->update([
            'name' => $inputs['name'] ?? $user->name,
            'username' => $inputs['username'] ?? $user->username,
            'email' => $inputs['email'] ?? $user->email,
            'phone' => $inputs['phone'] ?? $user->phone,
            'password' => $currentPassword,
        ]);

        return $user;
    }

    public function deleteUser($userId, $role)
    {
        return $this->getUserByRole($userId, $role)->delete();
    }
}
