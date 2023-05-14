<?php

namespace App\Http\Controllers\Api\Operator;

use App\Http\Requests\CustomAttributeRequest;
use App\Repositories\EntityRepository;
use Illuminate\Http\Request;

class EntityController
{
    public function __construct(private EntityRepository $entityRepository)
    {
    }

    public function getAll(Request $request)
    {
        try {
            $inputs = $request->validate([
                'per_page' => 'int',
                'page' => 'int'
            ]);

            $data = $this->entityRepository->getAllEntities(
                $inputs['per_page'] ?? 1000,
                $inputs['page'] ?? 1
            );

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

    public function get($entityId)
    {
        try {
            $data = $this->entityRepository->getEntityById($entityId);

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

    public function assignAttribute($entityId, CustomAttributeRequest $request)
    {
        try {

            $this->entityRepository->assignAttribute($entityId, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Custom attribute created and assigned to entity'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
