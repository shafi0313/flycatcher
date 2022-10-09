<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['payment_method_id'=>1,'name' => 'Bangladesh Bank', 'category' => 'Central Bank'],
            ['payment_method_id'=>1,'name' => 'Sonali Bank', 'category' => 'State-owned Commercial'],
            ['payment_method_id'=>1,'name' => 'Agrani Bank', 'category' => 'State-owned Commercial'],
            ['payment_method_id'=>1,'name' => 'Rupali Bank', 'category' => 'State-owned Commercial'],
            ['payment_method_id'=>1,'name' => 'Janata Bank', 'category' => 'State-owned Commercial'],
            ['payment_method_id'=>1,'name' => 'BRAC Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Dutch Bangla Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Eastern Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'United Commercial Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Mutual Trust Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Dhaka Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Islami Bank Bangladesh Ltd', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Uttara Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Pubali Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'IFIC Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'National Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'The City Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'NCC Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Mercantile Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Southeast Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Prime Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Social Islami Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Standard Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Al-Arafah Islami Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'One Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Exim Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'First Security Islami Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Bank Asia Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'The Premier Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Bangladesh Commerce Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Trust Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Jamuna Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Shahjalal Islami Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'ICB Islamic Bank', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'AB Bank', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Jubilee Bank Limited', 'category' => 'Private Commercial'],
            ['payment_method_id'=>1,'name' => 'Karmasangsthan Bank', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Bangladesh Krishi Bank', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Progoti Bank', 'category' => ''],
            ['payment_method_id'=>1,'name' => 'Rajshahi Krishi Unnayan Bank', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'BangladeshDevelopment Bank Ltd', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Bangladesh Somobay Bank Limited', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Grameen Bank', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'BASIC Bank Limited', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Ansar VDP Unnyan Bank', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'The Dhaka Mercantile Co-operative Bank Limited(DMCBL)', 'category' => 'Specialized Development'],
            ['payment_method_id'=>1,'name' => 'Citibank', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'HSBC', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'Standard Chartered Bank', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'CommercialBank of Ceylon', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'State Bank of India', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'WooriBank', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'Bank Alfalah', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'National Bank of Pakistan', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'ICICI Bank', 'category' => 'Foreign Commercial'],
            ['payment_method_id'=>1,'name' => 'Habib Bank Limited', 'category' => 'Foreign Commercial']
        ];

        DB::table('banks')->insert($banks);
    }

}
