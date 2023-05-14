<?php

namespace App\Repositories;

use App\Enums\EntityType;
use App\Models\Entity;

class EntityRepository
{
    public function getAllEntities($numberOfItems, $pageNo)
    {
        return Entity::query()->with('customAttributes', 'entities')->paginate(
            perPage: $numberOfItems,
            page: $pageNo
        );
    }
    public function getEntityById($id)
    {
        return Entity::with('customAttributes', 'entities')->find($id);
    }

    public function getEntityByName($name): Entity
    {
        return Entity::where('name', $name)->first();
    }

    public function createEntity($inputs)
    {
        return Entity::create([
            'name' => $inputs['name'],
            'description' => $inputs['description'],
            'type' => EntityType::from($inputs['type'])
        ]);
    }

    public function updateEntity($inputs)
    {
        $entity = $this->getEntityById($inputs['id']);

        $entity->update([
                'name' => $inputs['name'] ?? $entity->name,
                'description' => $inputs['description'] ?? $entity->description,
                'type' => EntityType::from($inputs['type'] ?? $entity->type)
            ]);
        return $entity;
    }

    public function deleteEntity($id)
    {
        return Entity::whereId($id)->delete();
    }

    public function assignAttribute($entityId, $inputs)
    {
        $entity = $this->getEntityById($entityId);
        $entity->assignCustomAttribute($inputs);
        $entity->refresh();
        return $entity;
    }

    public function assignEntity($inputs)
    {
        $primaryEntity = $this->getEntityById($inputs['primary_entity_id']);
        $secondaryEntity = $this->getEntityById($inputs['secondary_entity_id']);

        $primaryEntity->assignEntity($secondaryEntity);

        $primaryEntity->refresh();

        return $primaryEntity;
    }
}
