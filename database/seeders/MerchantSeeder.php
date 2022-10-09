<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Merchant::create([

            'id'=>'1',
            'area_id' =>1,
            'name' => 'Merchant',
            'company_name' => 'xyz traders',
            'email' => 'merchant@gmail.com',
            'mobile'=>'01777873960',
            'password' => bcrypt('12345678'),
            'status'=>'active',
            'isActive'=>'1'

        ]);

        Merchant::create([

            'id'=>'2',
            'area_id' =>1,
            'name' => 'Md Alomgir Hoassain',
            'company_name' => 'xyz traders',
            'email' => 'alom@gmail.com',
            'mobile'=>'01777873962',
            'password' => bcrypt('12345678'),
            'status'=>'pending',
            'isActive'=>'0'

        ]);
        Merchant::create([

            'id'=>3,
            'area_id' =>1,
            'name' => 'Mohammad Ali',
            'company_name' => 'E-Gallery',
            'email' => 'mdali89a@gmail.com',
            'mobile'=>'01710355789',
            'password' => bcrypt('12345678'),
            'status'=>'pending',
            'isActive'=>'0'

        ]);

//        $dataMerchant = [
//            [
//                'id'=>'1',
//                'area_id' =>1,
//                'name' => 'Merchant',
//                'company_name' => 'xyz traders',
//                'email' => 'merchant@gmail.com',
//                'mobile'=>'01777873960',
//                'password' => bcrypt('12345678'),
//            ],
//
//        ];
//
//        DB::table('merchants')->insert($dataMerchant);
    }
}
