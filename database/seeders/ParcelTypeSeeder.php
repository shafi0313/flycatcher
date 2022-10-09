<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelTypeSeeder extends Seeder
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
                'name'=>'Cloths',
            ],
            [
                'name'=>'Electronics',
            ],
            [
                'name'=>'Cosmetics ',
            ],
            [
                'name'=>'Paper',
            ],
        ];
        DB::table('parcel_types')->insert($data);
    }
}
