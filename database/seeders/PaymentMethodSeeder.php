<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
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
              'name'=>'Bank',
          ],
          [
              'name'=>'Mobile Banking',
          ],
        ];

        DB::table('payment_methods')->insert($data);
    }
}
