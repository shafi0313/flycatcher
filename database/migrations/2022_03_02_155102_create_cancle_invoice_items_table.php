<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancleInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancle_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
            $table->foreignId('cancle_invoice_id')->constrained('cancle_invoices')->onDelete('cascade');
            $table->enum('status', ['full_cancle', 'partial_cancle'])->default('full_cancle');
            $table->double('collection_amount', 8, 2);
            $table->double('cancle_amount', 8, 2);
            $table->double('delivery_charge', 8, 2);
            $table->double('cod_charge', 8, 2);
            $table->double('net_payable', 8, 2);
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
        Schema::dropIfExists('cancle_invoice_items');
    }
}
