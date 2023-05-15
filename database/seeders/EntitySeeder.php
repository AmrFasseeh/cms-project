<?php

namespace Database\Seeders;

use App\Enums\EntityType;
use App\Models\CustomAttribute;
use App\Models\Entity;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entity::factory()
            ->has(CustomAttribute::factory())
            ->hasAttached(
                Entity::factory()->create([
                    'name' => 'Harry Potter Book',
                    'description' => 'A book attached to students',
                    'type' => EntityType::BOOK,
                ])
            )
            ->count(20)
            ->create();
    }
}
