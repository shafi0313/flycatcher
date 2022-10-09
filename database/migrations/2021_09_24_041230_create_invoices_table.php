<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_id');// invoice id = created by
            $table->string('invoice_type');
            $table->unsignedBigInteger('prepare_for_id');
            $table->string('prepare_for_type');
            $table->string('invoice_number', 20);
            $table->double('total_collection_amount', 15, 2);
            $table->double('total_cod', 8, 2)->nullable();
            $table->double('total_delivery_charge', 15, 2);
            $table->dateTime('date')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->string('payment_method')->default('cash');
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
