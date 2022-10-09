<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_number'=>Str::random(8),
            'total_collection_amount'=>mt_rand(1000, 5000),
            'total_delivery_charge'=>mt_rand(10, 30),
            'total_cod'=>mt_rand(100, 500),
            'date'=>$this->faker->dateTime,
            'note'=>$this->faker->realTextBetween(20, 40),
            'merchant_id'=>Merchant::all()->random()->id,
            'created_by'=>Admin::all()->random()->id,
        ];
    }
}
