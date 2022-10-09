<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\Hub;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expense_head_id'=>ExpenseHead::all()->random()->id,
            'amount'=>mt_rand(100, 600),
            'note'=>$this->faker->realTextBetween(20, 40),
            'hub_id'=>Hub::all()->random()->id,
            'created_by'=>Admin::all()->random()->id,
        ];
    }
}
