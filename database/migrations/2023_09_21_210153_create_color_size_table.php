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
        Schema::create('color_size', function (Blueprint $table) {
            $table->id();

            //LLave foranea de color
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');;

            //LLave foranea size
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');;

            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_size');
    }
};
