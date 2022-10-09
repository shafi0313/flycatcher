<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('merchants')->onDelete('cascade');
            $table->unsignedBigInteger('service_type_id')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable()->constrained('admin')->onDelete('set null');
            $table->foreignId('assigning_by')->nullable()->constrained('riders')->onDelete('set null');
            $table->dateTime('assigning_time')->nullable()->default(null);
            $table->dateTime('picked_time')->nullable()->default(null);
            $table->dateTime('accepted_time')->nullable()->default(null);
            $table->dateTime('cancel_time')->nullable()->default(null);
            $table->enum('status', ['pending', 'processing', 'assigned', 'accepted','picked','cancelled'])->default('pending');
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
        Schema::dropIfExists('pickup_requests');
    }
}
