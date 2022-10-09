<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancle_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 20);
            $table->double('total_parcel_price', 15, 2);
            $table->double('total_collection_amount', 15, 2);
            $table->double('total_cod', 8, 2)->nullable();
            $table->double('total_delivery_charge', 15, 2);
            $table->double('total_payable', 15, 2);
            $table->enum('status', ['pending', 'transfer', 'received'])->default('pending');
            $table->dateTime('date')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreignId('merchant_id')->nullable()->constrained('merchants')->onDelete('cascade');
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('cascade');
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
        Schema::dropIfExists('cancle_invoices');
    }
}
