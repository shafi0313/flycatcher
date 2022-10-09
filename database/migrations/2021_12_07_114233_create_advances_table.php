<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('advance', 10, 2)->default(0);
            $table->decimal('total_advance', 10, 2)->default(0);
            $table->decimal('adjust', 10, 2)->default(0);
            $table->decimal('total_adjust', 10, 2)->default(0);
            $table->decimal('receivable', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('set null');;
            $table->enum('guard_name', ['admin', 'rider'])->default('admin');
            $table->foreignId('created_for_admin')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('created_for_rider')->nullable()->constrained('merchants')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->enum('status', [ 'active', 'inactive'])->default('active');
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
        Schema::dropIfExists('advances');
    }
}
