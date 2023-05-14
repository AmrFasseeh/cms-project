<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityHasEntity extends Model
{
    use HasFactory;

    public function customAttributes()
    {
        return $this->morphMany(CustomAttribute::class, 'customizable');
    }
}
