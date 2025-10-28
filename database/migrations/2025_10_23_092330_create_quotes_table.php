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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->string('quote_number')->unique();
            $table->text('description');
            $table->decimal('quantity', 10, 2);
            $table->string('unit')->default('kg');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired'])->default('pending');
            $table->date('valid_until');
            $table->text('terms_conditions')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};