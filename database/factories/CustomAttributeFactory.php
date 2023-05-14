<?php

namespace Database\Factories;

use App\Models\CustomAttribute;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomAttribute>
 */
class CustomAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 4,
            'value' => fake()->date,
            'customizable_id' => Entity::factory(),
            'customizable_type' => function (array $attributes) {
                return Entity::find($attributes['customizable_id'])->type;
            }
        ];
    }
}
