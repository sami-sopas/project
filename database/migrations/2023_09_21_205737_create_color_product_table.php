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
        Schema::create('color_product', function (Blueprint $table) {
            $table->id();

            //LLave foranea del color
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');;

            //LLave foranea del producto
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');;

            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_product');
    }
};
