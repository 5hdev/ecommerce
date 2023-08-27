<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ids = \App\Models\Category::pluck('id')->toArray();
        // print_r($this->faker->randomElement($ids));
        $name= $this->faker->words(5, true);
        return [
            'name' =>$name ,
            'slug' => str_replace(' ', '_', $name),
            'parent_id' => (count($ids)==0) ? null : $this->faker->optional(0.9, null)->randomElement($ids)
        ];
    }
}
