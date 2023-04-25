<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(15),
            'description' => $this->faker->text(150),
            'quantity' => rand(5,500),
            'price_per_item' => rand(10,50),
            'category_id' => rand(1,22),
            'in_stock' => true
        ];
    }
}
