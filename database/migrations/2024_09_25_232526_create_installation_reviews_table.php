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
        Schema::create('installation_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_code')->nullable();
            $table->string('bracketOne')->nullable();
            $table->string('mechanismOne')->nullable();
            $table->string('mechanismTwo')->nullable();
            $table->string('motorizedOne')->nullable();
            $table->string('motorizedTwo')->nullable();
            $table->string('motorizedThree')->nullable();
            $table->string('motorizedFour')->nullable();
            $table->string('accessoriesOne')->nullable();
            $table->string('accessoriesTwo')->nullable();
            $table->string('finalCheckOne')->nullable();
            $table->string('finalCheckTwo')->nullable();
            $table->string('finalCheckThree')->nullable();
            $table->string('finalCheckFour')->nullable();
            $table->string('installer_name')->nullable();
            $table->string('installer_signature')->nullable();
            $table->integer('agreement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installation_reviews');
    }
};
