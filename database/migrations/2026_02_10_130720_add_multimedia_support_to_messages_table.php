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
        Schema::table('messages', function (Blueprint $table) {
            // Make order_id nullable to support direct user-to-user messaging
            $table->foreignId('order_id')->nullable()->change();

            // Add message type column (text, image, video, voice)
            $table->enum('message_type', ['text', 'image', 'video', 'voice'])->default('text')->after('receiver_id');

            // Make message nullable since media messages might not have text
            $table->text('message')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['message_type']);

            // Revert order_id to not nullable
            $table->foreignId('order_id')->nullable(false)->change();

            // Revert message to not nullable
            $table->text('message')->nullable(false)->change();
        });
    }
};
