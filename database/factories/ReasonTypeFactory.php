<?php

namespace Database\Factories;

use App\Models\ReasonType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReasonTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReasonType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'reason_type'=>$this->faker->randomElement(['hold', 'cancel', 'both']),
        ];
    }
}
