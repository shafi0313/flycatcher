<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintParcelItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_parcel_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_parcel_id')->constrained('print_parcels')->onDelete('cascade');
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
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
        Schema::dropIfExists('print_parcel_items');
    }
}
