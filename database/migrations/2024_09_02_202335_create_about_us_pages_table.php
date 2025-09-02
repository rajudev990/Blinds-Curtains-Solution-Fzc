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
        Schema::create('about_us_pages', function (Blueprint $table) {
            $table->id();
            $table->string('bgimage')->nullable();
            $table->string('founder_title')->nullable();
            $table->string('founder_designation')->nullable();
            $table->string('founder_description')->nullable();
            $table->string('founder_image')->nullable();
            $table->string('cofounder_title')->nullable();
            $table->string('cofounder_designation')->nullable();
            $table->string('cofounder_description')->nullable();
            $table->string('cofounder_image')->nullable();
            $table->string('vision_title')->nullable();
            $table->string('vision_image')->nullable();
            $table->longText('vision_description')->nullable();
            $table->string('mission_title')->nullable();
            $table->string('mission_image')->nullable();
            $table->longText('mission_description')->nullable();
            $table->string('partnership_title')->nullable();
            $table->string('partnership_image')->nullable();
            $table->longText('partnership_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_pages');
    }
};
