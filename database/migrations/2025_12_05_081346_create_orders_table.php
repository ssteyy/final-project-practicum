<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->enum('status',['pending','accepted','in_progress','completed','cancelled'])->default('pending');
            $table->text('requirements')->nullable();
            $table->decimal('amount',10,2);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};