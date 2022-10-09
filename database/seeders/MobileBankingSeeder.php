<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobileBankingSeeder extends Seeder
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
                'payment_method_id'=>2,
                'name'=>'Bkash',
            ],
            [
                'payment_method_id'=>2,
                'name'=>'Rocket',
            ],
            [
                'payment_method_id'=>2,
                'name'=>'MCash',
            ],
            [
                'payment_method_id'=>2,
                'name'=>'SureCash',
            ],
            [
                'payment_method_id'=>2,
                'name'=>'Ucash',
            ],
            [
                'payment_method_id'=>2,
                'name'=>'Nagad-নগদ',
            ],
        ];
        DB::table('mobile_bankings')->insert($data);
    }
}
