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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('unpaid')->after('status');
            $table->string('khqr_md5')->nullable()->after('payment_status');
            $table->text('khqr_string')->nullable()->after('khqr_md5');
            $table->timestamp('paid_at')->nullable()->after('khqr_string');
            $table->string('transaction_reference')->nullable()->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'khqr_md5',
                'khqr_string',
                'paid_at',
                'transaction_reference',
            ]);
        });
    }
};
