<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileBankingCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_banking_collections', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
            $table->foreignId('mobile_banking_id')->nullable()->constrained('mobile_bankings')->onDelete('set null');
            $table->foreignId('merchant_mobile_banking_id')->nullable()->constrained('merchant_mobile_bankings')->onDelete('set null');
            $table->string('customer_mobile_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_banking_collections');
    }
}
