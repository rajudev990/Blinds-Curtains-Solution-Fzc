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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->string('order_type')->nullable();
            $table->string('qty')->nullable();
            $table->string('window_name')->nullable();
            $table->string('fullness')->nullable();
            $table->string('polling')->nullable();
            $table->string('width')->nullable();
            $table->string('opening')->nullable();
            $table->string('height_left')->nullable();
            $table->string('height_middle')->nullable();
            $table->string('height_right')->nullable();
            $table->string('location')->nullable();
            $table->string('lining')->nullable();
            $table->string('comment')->nullable();
            $table->string('catalouge')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('product_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
