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
        Schema::create('representatives', function (Blueprint $table) {
            $table->id('representative_id');
            $table->string('representative_name');
            $table->string('representative_email');
            $table->string('representative_phone');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('city_id')
                ->on('cities')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
