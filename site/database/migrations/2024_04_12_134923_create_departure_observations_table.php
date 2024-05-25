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
        Schema::create('departure_observations', function (Blueprint $table) {
            $table->unsignedBigInteger('departure_id');
            $table->unsignedBigInteger('observation_id');
            $table->timestamps();

            $table->primary(['departure_id', 'observation_id']);

            $table->foreign('departure_id')->references('id')->on('departures');
            $table->foreign('observation_id')->references('id')->on('observations');

            $table->unique(['departure_id', 'observation_id'], 'departure_observation_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_observations');
    }
};
