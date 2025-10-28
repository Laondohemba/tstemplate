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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade'); // Links message to a chat
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Who sent the message
            $table->text('message')->nullable(); // The message content
            $table->string('attachment')->nullable();
            $table->boolean('is_read')->default(false); // Read/unread status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
