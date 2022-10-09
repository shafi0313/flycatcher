<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Hub;
use Database\Factories\Admin\RiderFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RiderSeeder extends Seeder
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
                'hub_id'=>Hub::all()->random()->id,
                'area_id'=>Area::all()->random()->id,
                'name' => 'Ikram Asif Khan Radi',
                'rider_code'=>'ps-01',
                'email' => 'rider@gmail.com',
                'mobile' => '01777873960',
                'password' => bcrypt('12345678'),

            ],
            [
                'hub_id'=>Hub::all()->random()->id,
                'area_id'=>Area::all()->random()->id,
                'name' => 'Rafsan Al Shefatul Islam Subad',
                'rider_code'=>'ps-02',
                'email' => 'rider2@gmail.com',
                'mobile' => '01710355789',
                'password' => bcrypt('12345678'),

            ],
            [
                'hub_id'=>Hub::all()->random()->id,
                'area_id'=>Area::all()->random()->id,
                'name' => 'Mohammad Kholilur Rahman',
                'rider_code'=>'ps-03',
                'email' => 'rider3@gmail.com',
                'mobile' => '01777873965',
                'password' => bcrypt('12345678'),

            ],
            [
                'hub_id'=>Hub::all()->random()->id,
                'area_id'=>Area::all()->random()->id,
                'name' => 'Haris Ahmed',
                'rider_code'=>'ps-04',
                'email' => 'rider4@gmail.com',
                'mobile' => '01777873966',
                'password' => bcrypt('12345678'),

            ],
            [
                'hub_id'=>Hub::all()->random()->id,
                'area_id'=>Area::all()->random()->id,
                'name' => 'Mohammad Shah Niwaz ',
                'rider_code'=>'ps-06',
                'email' => 'rider6@gmail.com',
                'mobile' => '01777873967',
                'password' => bcrypt('12345678'),

            ],
        ];

        DB::table('riders')->insert($data);
    }
}
