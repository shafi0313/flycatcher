<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuardNameAddedByAdminAddedByMerchantToParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->enum('guard_name', ['admin', 'merchant'])->default('admin');
            $table->foreignId('added_by_admin')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('added_by_merchant')->nullable()->constrained('merchants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcels');
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn([
                'guard_name', 'added_by_admin', 'added_by_merchant'
            ]);
        });
    }
}
