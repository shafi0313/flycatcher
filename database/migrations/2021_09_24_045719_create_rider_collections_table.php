<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_collections', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2);
            $table->decimal('collection_amount', 8, 2)->nullable();
            $table->decimal('delivery_charge', 8, 2);
            $table->decimal('cod_charge', 8, 2);
            $table->decimal('net_payable', 8, 2);
            $table->decimal('cancle_amount', 8, 2)->default(0.00);
            $table->foreignId('merchant_id')->nullable()->constrained('merchants')->onDelete('set null');
            $table->foreignId('parcel_id')->unique()->constrained('parcels')->onDelete('cascade');
            $table->foreignId('tracking_id')->nullable()->constrained('parcels')->onDelete('cascade');
            $table->foreignId('rider_collected_by')->nullable()->constrained('riders')->onDelete('set null');
            $table->dateTime('rider_collected_time')->nullable();
            $table->enum('rider_collected_status', ['collected', 'transfer_request', 'transferred'])->default('collected');
            $table->dateTime('rider_transfer_request_time')->nullable();
            $table->foreignId('incharge_collected_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->dateTime('incharge_collected_time')->nullable();
            $table->enum('incharge_collected_status', ['collected', 'transfer_request', 'transferred'])->nullable();
            $table->dateTime('incharge_transfer_request_time')->nullable();
            $table->foreignId('accounts_collected_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->dateTime('accounts_collected_time')->nullable();
            $table->enum('accounts_collected_status', ['collected'])->nullable();
            $table->enum('merchant_paid', ['paid', 'unpaid', 'received'])->default('unpaid');
            $table->dateTime('merchant_paid_time')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('rider_collections');
    }
}
