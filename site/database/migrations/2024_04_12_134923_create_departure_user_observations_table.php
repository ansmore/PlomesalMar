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
        Schema::create('departure_user_observations', function (Blueprint $table) {
            $table->unsignedBigInteger('departure_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('observation_id');
            $table->boolean('is_observer')->default(0);
            $table->timestamps();

            $table->primary(['departure_id', 'user_id', 'observation_id']);

            $table->foreign('departure_id')->references('id')->on('departures');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('observation_id')->references('id')->on('observations');

            $table->unique(['departure_id', 'user_id', 'observation_id'], 'departure_user_observation_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_user_observations');
    }
};
