<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "store_entered_id" => $this->faker->numberBetween(1, 30),
            "floor_number" => $this->faker->numberBetween(1, 3)
        ];
    }
}
