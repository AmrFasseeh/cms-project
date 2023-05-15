<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEntityRequest;
use App\Http\Requests\CustomAttributeRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Repositories\EntityRepository;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function __construct(private EntityRepository $entityRepository)
    {
    }

    public function getAll(Request $request)
    {
        try {
            $inputs = $request->validate([
                'per_page' => 'int',
                'page' => 'int',
            ]);

            $data = $this->entityRepository->getAllEntities(
                $inputs['per_page'] ?? 12,
                $inputs['page'] ?? 1
            );

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function get($entityId)
    {
        try {
            $data = $this->entityRepository->getEntityById($entityId);

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function create(CreateEntityRequest $request)
    {
        try {

            $this->entityRepository->createEntity($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Entity created successfully',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateEntityRequest $request)
    {
        try {
            $entity = $this->entityRepository->updateEntity($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Entity updated successfully',
                'data' => $entity,
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $entityId = $request->only('id');

            if (! $this->entityRepository->deleteEntity($entityId)) {
                throw new \Exception('Something went wrong');
            }

            return response()->json([
                'status' => true,
                'message' => 'Entity deleted successfully',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function assignAttribute($entityId, CustomAttributeRequest $request)
    {
        try {

            $this->entityRepository->assignAttribute($entityId, $request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Custom attribute created and assigned to entity',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function assignEntity(Request $request)
    {
        try {
            $validatedDate = $request->validate([
                'primary_entity_id' => 'required|int',
                'secondary_entity_id' => 'required|int',
            ]);

            $this->entityRepository->assignEntity($validatedDate);

            return response()->json([
                'status' => true,
                'message' => 'Entities assigned successfully',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
