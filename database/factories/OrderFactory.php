<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'firstname' => $this->faker->words(1, true),
            'lastname' => $this->faker->words(1, true),
            'subtotal' => $this->faker->randomNumber(3),
            'tax' => $this->faker->randomNumber(2),
            'total' => $this->faker->randomNumber(4),
            'discount' => $this->faker->randomNumber(1),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => $this->faker->randomNumber(9),
            'line1' => $this->faker->sentence(7),
            'city' => $this->faker->words(1, true),
            'user_id' => $this->faker->randomElement($user_ids),
        ];
    }
}
