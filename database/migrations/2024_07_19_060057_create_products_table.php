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

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('price_rate')->nullable();
            $table->string('base_charge')->nullable();
            $table->string('additional_charge')->nullable();
            $table->string('cm_length')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(1);
            $table->string('sku')->unique();
            $table->string('estimate_status')->default(0);
            $table->string('featured_status')->default(0);
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

