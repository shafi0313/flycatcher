<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
            $table->enum('time_type', ['wait_for_pickup','received_at_office','pending','delivered','partial','partial_accept_by_incharge','partial_accept_by_merchant','hold','transit','undo','return','cancelled','hold_accept_by_incharge','hold_parcel_transfer_to_rider','cancel_accept_by_incharge','cancel_accept_by_merchant','transfer_create','transfer_accept','transfer_decline','exchange','exchange_accept_by_incharge','exchange_accept_by_merchant'])->default('pending');
            $table->dateTime('time');
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
        Schema::dropIfExists('parcel_times');
    }
}
