<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('set null');
            $table->string('order_number')->unique();
            $table->text('product_details');
            $table->decimal('quantity', 10, 2);
            $table->string('unit')->default('kg');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->string('tracking_number')->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->date('delivered_at')->nullable();
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};