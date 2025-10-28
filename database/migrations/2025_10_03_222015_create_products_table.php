<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('slug');
            $table->string('product_name');
            $table->enum('sales_type', ['retail', 'wholesale', 'both retail and wholesale']);
            $table->enum('sales_niche', ['organic', 'inorganic']);
            $table->decimal('price', 10, 2);
            $table->string('currency');
            $table->decimal('quantity_available', 10, 2);
            $table->string('location');
            $table->enum('shipping', ['local', 'international', 'both local and international']);
            $table->json('images'); // Changed to json
            $table->string('video_link')->nullable();
            $table->text('description');
            $table->text('specifications')->nullable();
            $table->enum('status', ['available', 'unavailable', 'featured', 'disabled'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
