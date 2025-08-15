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
        Schema::create('week_times', function (Blueprint $table) {
            $table->id();
            $table->string('week_time')->nullable();         // e.g., "08:30 PM" or "20:30"
            $table->enum('time_format', ['12', '24'])->default('24'); // Time format: 12-hour or 24-hour
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('week_times');
    }
};
