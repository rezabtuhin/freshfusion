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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('price_per_quantity')->nullable(false);
            $table->string('discount')->nullable();
            $table->longText('description');
            $table->string('image');
            $table->string('availability');
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('vendor');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('vendor')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
