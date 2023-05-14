<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getAll(Request $request)
    {
        try {
            $inputs = $request->validate([
                'per_page' => 'int',
                'page' => 'int'
            ]);

            $data = $this->userRepository->getAllUsers('operator', $inputs);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function get($operatorId)
    {
        try {
            $data = $this->userRepository->getUserById($operatorId);

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function create(CreateUserRequest $request)
    {
        try {
            $operator = $this->userRepository->createUser($request->validated());
            $operator->assignRole('operator');

            return response()->json([
                'status' => true,
                'message' => 'Operator created successfully',
                'data' => $operator
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $operator = $this->userRepository->updateUser($request->validated(), 'operator');

            return response()->json([
                'status' => true,
                'message' => 'Operator updated successfully',
                'data' => $operator
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $userId = $request->only('id');

            $operator = $this->userRepository->deleteUser($userId, 'operator');

            return response()->json([
                'status' => true,
                'message' => 'Operator deleted successfully'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
