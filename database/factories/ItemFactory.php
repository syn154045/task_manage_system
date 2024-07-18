<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    private static int $seq = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::ulid(),
            'name' => 'sample'.self::$seq++,
            'code' => fake()->ean8(),
            'type' => fake()->monthName(),
            'description' => fake()->sentence(),
        ];
    }
}
