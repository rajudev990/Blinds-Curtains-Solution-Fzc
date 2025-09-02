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
        Schema::create('section_titles', function (Blueprint $table) {
            $table->id();
            $table->string('home_section_title')->nullable();
            $table->string('service_section_title')->nullable();
            $table->longText('service_section_description')->nullable();
            $table->string('best_seller_section_title')->nullable();
            $table->longText('best_seller_section_description')->nullable();
            $table->string('portfolio_section_title')->nullable();
            $table->longText('portfolio_section_description')->nullable();
            $table->string('client_section_title')->nullable();
            $table->longText('client_section_description')->nullable();
            $table->string('product_section_title')->nullable();

            $table->string('about_us_section_title')->nullable();
            $table->longText('about_us_section_description')->nullable();

            $table->string('team_section_title')->nullable();
            $table->longText('team_section_description')->nullable();

            $table->string('contact_section_title')->nullable();
            $table->longText('contact_section_description')->nullable();

            $table->string('book_section_title')->nullable();
            $table->longText('book_section_description')->nullable();

            $table->string('next_section_title')->nullable();
            $table->longText('next_section_description')->nullable();

            $table->string('getestimate_section_title_one')->nullable();
            $table->string('getestimate_section_title_two')->nullable();
            $table->string('getestimate_section_title_three')->nullable();
            $table->string('getestimate_section_title_four')->nullable();
            $table->string('help_section_title')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_titles');
    }
};
