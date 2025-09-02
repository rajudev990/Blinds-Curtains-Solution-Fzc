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
        Schema::create('why_kurtains', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('why_kurtains')->default(0);
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_kurtains');
    }
};
