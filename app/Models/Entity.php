<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    public function customAttributes()
    {
        return $this->morphMany(CustomAttribute::class, 'customizable');
    }

    public function entities()
    {
        return $this->belongsToMany(Entity::class, EntityHasEntity::class, 'primary_entity_id', 'secondary_entity_id');
    }

    public function assignEntity($entity)
    {
        $this->entities()->attach($entity);
    }

    public function assignCustomAttribute($attribute)
    {
        return $this->customAttributes()->create($attribute);
    }
}
