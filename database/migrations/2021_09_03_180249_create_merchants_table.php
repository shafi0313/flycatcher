<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('cascade');
            $table->string('name');
            $table->string('company_name');
            $table->foreignId('area_id')->nullable()->constrained('areas')->onDelete('set null');
            $table->string('mobile')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('website_url')->nullable()->unique();
            $table->string('prefix')->nullable()->unique();
            $table->string('facebook_page')->nullable()->unique();
            $table->longText('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['pending','active', 'inactive'])->default('pending');
            $table->enum('isActive', [1,0])->default(0);
            $table->enum('isSend', [1,0])->default(0);
            $table->enum('isReturnCharge', ['apply', 'not_apply'])->default('not_apply');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->rememberToken();
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
        Schema::dropIfExists('merchants');
    }
}
