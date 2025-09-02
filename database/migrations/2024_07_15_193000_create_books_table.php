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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->dateTime('booking_date');
            $table->string('booking_time_id')->nullable();
            $table->string('book_id')->nullable();
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_country')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('flat_no')->nullable();
            $table->string('windows_number')->nullable();
            $table->text('comment')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
