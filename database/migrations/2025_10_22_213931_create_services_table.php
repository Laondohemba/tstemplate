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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Service provider
            $table->foreignId('service_category_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('contact_person')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('location'); // City/State
            $table->string('coverage_area')->nullable(); // e.g., "Nationwide", "Lagos, Abuja"
            $table->json('services_offered')->nullable(); // Array of specific services
            $table->json('images')->nullable(); // Array of service images
            $table->string('website')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00); // Average rating
            $table->integer('reviews_count')->default(0);
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('verification_badge')->nullable(); // e.g., "Verified", "Government Approved"
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
