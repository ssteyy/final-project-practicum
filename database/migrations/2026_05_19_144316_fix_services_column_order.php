<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure correct order: original_price → platform_fee → price
        DB::statement("ALTER TABLE services DROP COLUMN IF EXISTS original_price");
        DB::statement("ALTER TABLE services DROP COLUMN IF EXISTS platform_fee");

        DB::statement("ALTER TABLE services ADD original_price DECIMAL(10,2) NULL AFTER freelancer_id");
        DB::statement("ALTER TABLE services ADD platform_fee DECIMAL(10,2) NULL AFTER original_price");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE services DROP COLUMN IF EXISTS original_price");
        DB::statement("ALTER TABLE services DROP COLUMN IF EXISTS platform_fee");
    }
};
