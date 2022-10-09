<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmsConfigureSeeder extends Seeder
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
                'appId' => 1,
                'apiKey' => '',
                'senderId' => '',
                'status' => '',
            ],
        ];
        DB::table('sms_configures')->insert($data);
    }
}
