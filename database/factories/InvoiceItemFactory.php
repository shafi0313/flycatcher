<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use App\Models\Parcel;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parcel_id'=>Parcel::all()->random()->id
        ];
    }
}
