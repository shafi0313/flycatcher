<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightRangeSeeder extends Seeder
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
                'min_weight'=>0,
                'max_weight'=>1,
                'code'=>1
            ],
            [
                'min_weight'=>1,
                'max_weight'=>2,
                'code'=>2
            ],
            [
                'min_weight'=>2,
                'max_weight'=>5,
                'code'=>3
            ],
        ];
        DB::table('weight_ranges')->insert($data);
    }
}
