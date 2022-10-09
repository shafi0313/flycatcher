<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTypeSeeder extends Seeder
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
                'name' => 'Inside City'
            ],
            [
                'name' => 'Sub City'
            ],
            [
                'name' => 'Outside City'
            ],

        ];
        DB::table('city_types')->insert($data);
    }
}
