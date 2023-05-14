<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminInputs = [
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '123456789',
            'email' => 'admin@cms.loc',
            'password' => 'password'
        ];

        $admin = $this->userRepository->getUserByUsername('admin');
        if (!$admin) {
            $admin = $this->userRepository->createUser($adminInputs);
        }
        $admin->assignRole('admin');

        $operatorInputs = [
            'name' => 'Operator',
            'username' => 'operator',
            'phone' => '123456999',
            'email' => 'operator@cms.loc',
            'password' => 'password'
        ];

        $operator = $this->userRepository->getUserByUsername('operator');
        if (!$operator) {
            $operator = $this->userRepository->createUser($operatorInputs);
        }
        $operator->assignRole('operator');
    }
}
