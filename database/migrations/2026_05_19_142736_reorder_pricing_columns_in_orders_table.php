<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL for reliable column reordering
        DB::statement("ALTER TABLE orders DROP COLUMN IF EXISTS original_price");
        DB::statement("ALTER TABLE orders DROP COLUMN IF EXISTS platform_fee");
        
        DB::statement("ALTER TABLE orders ADD original_price DECIMAL(10,2) NULL AFTER requirements");
        DB::statement("ALTER TABLE orders ADD platform_fee DECIMAL(10,2) NULL AFTER original_price");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['original_price', 'platform_fee']);
        });
    }
};
