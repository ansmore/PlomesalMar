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
        Schema::create('departures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->unsignedBigInteger('transect_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('boat_id')->references('id')->on('boats');
            $table->foreign('transect_id')->references('id')->on('transects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departures');
    }
};
