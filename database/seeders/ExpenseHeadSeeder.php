<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
            [
                'title' => 'Entertaintment',
            ],
            [
                'title' => 'Printinig & Stationary',
            ],
            [
                'title' => 'Convence',
            ],
            [
                'title' => 'Fuel',
            ],
            [
                'title' => 'Computer',
            ],
            [
                'title' => 'Funiture',
            ],
            [
                'title' => 'House Rent',
            ],
            [
                'title' => 'Hardware & Cookwarise',
            ],
            [
                'title' => 'Miscellaneous',
            ],
            [
                'title' => 'Electric',
            ],
            [
                'title' => 'Salary',
            ],
            [
                'title' => 'Mobile Bill',
            ],
            [
                'title' => 'Dhaka Trade',
            ],
            [
                'title' => 'Mobile Parcel',
            ],
            [
                'title' => 'Tips',
            ],
            [
                'title' => 'Bicycle',
            ],
            [
                'title' => 'Courier',
            ],
            [
                'title' => 'Internet Bill',
            ],
            [
                'title' => 'Overtime',
            ],
            [
                'title' => 'House Rent',
            ],
            [
                'title' => 'Sports',
            ],
            [
                'title' => 'Accessories',
            ],
           
        ];

        DB::table('expense_heads')->insert($expenses);
    }
}
