<?php

namespace Database\Factories;

use App\Models\Drug;
use App\Models\Ingredient;
use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrugFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drug::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomDigitNotNull,
            'ingredient_id' => Ingredient::inRandomOrder()->first()->id,
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()->id,
        ];
    }
}
