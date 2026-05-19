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
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('original_price', 10, 2)->after('price');
            $table->decimal('platform_fee', 10, 2)->after('original_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'original_price')) {
                $table->dropColumn('original_price');
            }
            if (Schema::hasColumn('services', 'platform_fee')) {
                $table->dropColumn('platform_fee');
            }
        });
    }
};
