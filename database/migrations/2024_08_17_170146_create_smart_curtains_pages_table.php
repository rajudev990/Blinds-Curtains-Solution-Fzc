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
        Schema::create('smart_curtains_pages', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image')->nullable();
            $table->string('banner_title')->nullable();
            $table->longText('banner_description')->nullable();
            $table->string('title')->nullable();
            $table->string('title_description')->nullable();
            $table->longText('title_text')->nullable();
            $table->string('step_one_title')->nullable();
            $table->longText('step_one_description')->nullable();
            $table->string('step_one_title_one')->nullable();
            $table->longText('step_one_title_one_description')->nullable();
            $table->string('step_one_title_two')->nullable();
            $table->longText('step_one_title_two_description')->nullable();
            $table->string('step_two_title')->nullable();
            $table->string('step_two_description')->nullable();
            $table->string('step_two_image')->nullable();
            $table->string('step_three_title')->nullable();
            $table->string('step_three_description')->nullable();
            $table->string('step_four_title')->nullable();
            $table->string('step_five_title')->nullable();
            $table->longText('step_five_description')->nullable();
            $table->string('step_six_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_curtains_pages');
    }
};
