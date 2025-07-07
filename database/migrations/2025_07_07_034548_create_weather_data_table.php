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
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->date('date');
            $table->float('temperature')->nullable();
            $table->float('rain')->nullable();
            $table->string('weather')->nullable();
            $table->timestamps();

            $table->unique(['location', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }

};
