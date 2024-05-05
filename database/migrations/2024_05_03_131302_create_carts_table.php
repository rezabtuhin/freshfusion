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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('food')->onDelete('cascade');
            $table->integer('quantity');
            $table->foreignId('vendor')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('checkout')->default(0)->comment('0: Not Checked Out, 1: Checked Out');
            $table->foreignId('order_token')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
