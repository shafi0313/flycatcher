 <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateParcelsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('parcels', function (Blueprint $table) {
                $table->id();
                $table->foreignId('hub_id')->nullable()->constrained('hubs')->onDelete('cascade');
                $table->foreignId('city_type_id')->nullable()->constrained('city_types')->onDelete('set null');
                $table->foreignId('area_id')->nullable()->constrained('areas')->onDelete('cascade');
                $table->foreignId('sub_area_id')->nullable()->constrained('sub_areas')->onDelete('cascade');
                $table->foreignId('merchant_id')->nullable()->constrained('merchants')->onDelete('set null');
                $table->foreignId('weight_range_id')->nullable()->constrained('weight_ranges')->onDelete('set null');
                $table->foreignId('parcel_type_id')->nullable()->constrained('parcel_types')->onDelete('set null');
                $table->string('tracking_id')->unique()->nullable();
                $table->string('invoice_id')->nullable();
                $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('unpaid');
                $table->enum('payment_type', ['not_payment_yet', 'cash_on_delivery', 'mobile_banking'])->default('not_payment_yet');
                $table->text('note')->nullable();
                $table->unsignedBigInteger('assigned_by')->nullable();
                $table->foreignId('assigning_by')->nullable()->constrained('riders')->onDelete('set null');
                $table->string('customer_name')->nullable();
                $table->text('customer_address')->nullable();
                $table->string('customer_mobile')->nullable();
                $table->string('customer_another_mobile')->nullable();
                $table->decimal('collection_amount', 10, 2)->default(0.00);
                $table->decimal('delivery_charge', 10, 2)->default(0.00);
                $table->decimal('cod_percentage', 10, 2)->default(0.00);
                $table->decimal('cod', 10, 2)->default(0.00);
                $table->decimal('payable', 10, 2)->default(0.00);
                $table->unsignedInteger('return_product')->default(0);
                $table->enum('is_transfer', ['yes', 'no'])->default('no');
                $table->enum('status', ['wait_for_pickup', 'received_at_office', 'processing', 'pending', 'transit', 'transfer', 'delivered', 'partial', 'partial_accept_by_incharge', 'partial_accept_by_merchant', 'hold', 'hold_accept_by_incharge', 'exchange','exchange_accept_by_incharge', 'exchange_accept_by_merchant', 'cancelled', 'cancel_accept_by_incharge', 'cancel_accept_by_merchant'])->default('pending');
                $table->enum('delivery_status', ['processing', 'delivered', 'partial', 'partial_accept_by_incharge', 'partial_accept_by_merchant', 'hold', 'hold_accept_by_incharge', 'exchange','exchange_accept_by_incharge', 'exchange_accept_by_merchant', 'cancelled', 'cancel_accept_by_incharge', 'cancel_accept_by_merchant'])->default('processing');
                $table->integer('transit_count')->default(0);
                $table->date('added_date')->useCurrent();
                $table->enum('cancle_partial_invoice', ['no', 'yes'])->nullable();
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
            Schema::dropIfExists('parcels');
        }
    }
