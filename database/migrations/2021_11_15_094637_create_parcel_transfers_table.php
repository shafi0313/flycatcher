<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
            $table->foreignId('transfer_by')->constrained('riders')->onDelete('cascade');
            $table->foreignId('transfer_for')->constrained('riders')->onDelete('cascade');
            $table->foreignId('transfer_sub_area')->nullable()->constrained('sub_areas')->onDelete('set null');
            $table->enum('status', [ 'pending', 'accept', 'reject'])->default('pending');
            $table->foreignId('accept_or_reject_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->dateTime('accept_time')->nullable();
            $table->dateTime('reject_time')->nullable();
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
        Schema::dropIfExists('parcel_transfers');
    }
}
