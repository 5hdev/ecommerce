<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $order_ids = \App\Models\User::pluck('id')->toArray();
        $product_ids = \App\Models\Product::pluck('id')->toArray();

        return [
            'price' => $this->faker->randomNumber(3),
            'quantity' => $this->faker->randomNumber(1),
            'product_id' => $this->faker->randomElement($product_ids),
            'order_id' => $this->faker->randomElement($order_ids),
        ];
    }
}
