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
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('species_id');
            $table->string('waypoint');
            $table->integer('number_of_individuals');
            $table->boolean('in_flight')->default(false);
            $table->boolean('distance_under_300m')->default(false);
            $table->text('notes')->nullable();
            $table->foreign('species_id')->references('id')->on('species');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
