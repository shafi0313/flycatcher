<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\SubArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_id'=>Area::all()->random()->id,
            'name'=>$this->faker->streetName,
            'code'=>mt_rand(1111, 9999),
        ];
    }
}
