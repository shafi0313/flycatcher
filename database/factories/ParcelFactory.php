<?php

namespace Database\Factories;

use App\Models\Admin\Rider;
use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\CityType;
use App\Models\Merchant;
use App\Models\ParcelType;
use App\Models\WeightRange;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParcelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parcel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'city_type_id' => CityType::all()->random()->id,
            'area_id' => Area::all()->random()->id,
            'sub_area_id' => SubArea::all()->random()->id,
//            'merchant_id' => Merchant::all()->random()->id,
            'merchant_id' => 1,
            'weight_range_id' => WeightRange::all()->random()->id,
            'parcel_type_id' => ParcelType::all()->random()->id,
            'assigning_by' => Rider::all()->random()->id,
            'payment_status' => $name,
            'tracking_id'=>Str::random(8),
            'invoice_id'=>$this->faker->unique()->numberBetween(11111111,99999999),
            'note'=>$this->faker->realText(20, 1),
            'customer_name'=>$this->faker->name,
            'customer_address'=>$this->faker->address,
            'customer_mobile'=>$this->faker->unique->phoneNumber,
            'collection_amount'=>mt_rand(500, 1000),
            'delivery_charge'=>mt_rand(50, 70),
            'cod_percentage'=>mt_rand(1, 3),
            'cod'=>mt_rand(10, 30),
            'status'=>'pending'
        ];
    }
}
