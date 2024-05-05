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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_token', 8)->unique();
            $table->foreignId('order_taken_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('current_status')->nullable();
            $table->foreignId('order_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('vendor')->constrained('users')->onDelete('cascade');
            $table->string('location');
            $table->string('payment_status')->default('unpaid');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->tinyInteger('delivered')->default(0)->comment('0: Not Delivered, 1: Delivered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
