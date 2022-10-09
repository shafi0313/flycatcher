<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'city_type_id' => 1,
                'weight_range_id' => 1,
                'delivery_charge' => 60,
                'cod' => 1,
                'status' => 'active'
            ],
            [
                'city_type_id' => 1,
                'weight_range_id' => 2,
                'delivery_charge' => 80,
                'cod' => 1,
                'status' => 'active'
            ], [
                'city_type_id' => 1,
                'weight_range_id' => 3,
                'delivery_charge' => 100,
                'cod' => 1,
                'status' => 'active'
            ],
            [
                'city_type_id' => 2,
                'weight_range_id' => 1,
                'delivery_charge' => 80,
                'cod' => 1,
                'status' => 'active'
            ],
            [
                'city_type_id' => 2,
                'weight_range_id' => 2,
                'delivery_charge' => 120,
                'cod' => 1,
                'status' => 'active'
            ], [
                'city_type_id' => 2,
                'weight_range_id' => 3,
                'delivery_charge' => 200,
                'cod' => 1,
                'status' => 'active'
            ],
            [
                'city_type_id' => 3,
                'weight_range_id' => 1,
                'delivery_charge' => 100,
                'cod' => 2,
                'status' => 'active'
            ],
            [
                'city_type_id' => 3,
                'weight_range_id' => 2,
                'delivery_charge' => 150,
                'cod' => 2,
                'status' => 'active'
            ], [
                'city_type_id' => 3,
                'weight_range_id' => 3,
                'delivery_charge' => 300,
                'cod' => 2,
                'status' => 'active'
            ],
        ];
        DB::table('delivery_charges')->insert($data);
    }
}
