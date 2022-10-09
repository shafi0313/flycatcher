<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'city_type_id'=>1,
                'district_id'=>65,
                'upazila_id'=>512,
                'area_name'=>'Mirpur Zone',
                'area_code'=>'1216'
            ],
        ];
        DB::table('areas')->insert($data);
    }
}
