<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Parcel;
use App\Models\Reason;
use App\Models\ReasonType;
use App\Models\Admin\Rider;
use App\Models\PickupRequest;
use App\Models\PaymentRequest;
use App\Models\SubArea;
use Illuminate\Database\Seeder;
use Database\Factories\ReasonTypeFactory;
use Database\Factories\Admin\RiderFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ReasonType::factory(30)->create();
        $this->call(PaymentMethodSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(MobileBankingSeeder::class);
        $this->call(ParcelTypeSeeder::class);
        $this->call(WeightRangeSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);
        $this->call(CityTypeSeeder::class);
        //$this->call(AreaSeeder::class);
        //SubArea::factory()->count(20)->create();
        $this->call(HubSeeder::class);
        //$this->call(DeliveryChargeSeeder::class);
        $this->call(AccessControlsTableSeeder::class);
//        $this->call(MerchantSeeder::class);
//        $this->call(RiderSeeder::class);
        $this->call(ExpenseHeadSeeder::class);
//          PickupRequest::factory(50)->create();
//          Parcel::factory(5)->create();
//          Expense::factory(5)->create();
        //  PaymentRequest::factory(1000)->create();


        // Invoice::factory(200)
        //     ->has(
        //         InvoiceItem::factory()
        //             ->count(3)
        //             ->state(function (array $attributes, Invoice $invoice) {
        //                 return ['invoice_id' => $invoice->id];
        //             })
        //     )
        //     ->create();
    }
}
