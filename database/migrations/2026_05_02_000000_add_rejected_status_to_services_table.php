<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Modify the status enum to include 'rejected'
            $table->enum('status', ['draft', 'published', 'archived', 'rejected', 'pending'])->default('draft')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Revert to original enum values
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->change();
        });
    }
};
