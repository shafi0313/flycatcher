<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HubSeeder extends Seeder
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
                'name'=>'Central Hub',
                'hub_code'=>'1216',
                'hub_type'=>'central',
            ],
        ];
        DB::table('hubs')->insert($data);
    }
}
