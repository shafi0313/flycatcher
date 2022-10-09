<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_notes', function (Blueprint $table) {
            $table->id();
            $table->enum('guard_name',['admin', 'merchant', 'rider'])->default('admin');
            $table->foreignId('parcel_id')->constrained('parcels')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('merchant_id')->nullable()->constrained('merchants')->onDelete('set null');
            $table->foreignId('rider_id')->nullable()->constrained('riders')->onDelete('set null');
            $table->longText('note');
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
        Schema::dropIfExists('parcel_notes');
    }
}
