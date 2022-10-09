<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('set null');
            $table->foreignId('area_id')->nullable()->constrained('areas')->onDelete('set null');
            $table->string('name');
            $table->string('rider_code')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('nid')->nullable()->unique();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('salary_type', ['commission', 'fixed'])->default('fixed');
            $table->enum('commission_type', ['percentage', 'fixed'])->nullable();
            $table->decimal('commission_rate', 10,2)->nullable();
            $table->enum('isActive', [1,0])->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('riders');
    }
}
