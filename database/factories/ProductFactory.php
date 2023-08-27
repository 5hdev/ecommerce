<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = \App\Models\User::pluck('id')->toArray();

        return [
            'name' => $this->faker->words(5, true),
            'detail' => $this->faker->sentence(45),
            'stock' => $this->faker->randomNumber(5),
            'discount' => $this->faker->randomNumber(1),
            'price' => $this->faker->randomNumber(3),
            'user_id' => $this->faker->randomElement($user_ids),

        ];
    }
}
