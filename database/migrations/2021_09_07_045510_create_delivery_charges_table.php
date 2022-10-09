<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->nullable()->constrained('merchants')->onDelete('cascade');
            $table->foreignId('city_type_id')->constrained('city_types')->onDelete('cascade');
            $table->foreignId('weight_range_id')->constrained('weight_ranges')->onDelete('cascade');
            $table->decimal('delivery_charge', 10,2);
            $table->decimal('cod', 10,2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_global', ['yes', 'no'])->default('yes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_charges');
    }
}
