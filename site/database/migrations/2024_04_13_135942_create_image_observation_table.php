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
        Schema::create('observation_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('observation_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('photography_number');

            $table->timestamps();

            $table->foreign('observation_id')->references('id')->on('observations')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('cascade');

                  $table->unique(['photography_number', 'observation_id', 'user_id'], 'obs_img_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('observation_image', function(Blueprint $table){
            $table->dropForeign(['observation_id']);
            $table->dropForeign(['user_id']);
            $table->dropUnique('obs_img_unique');
        });
        Schema::dropIfExists('observation_image');
    }
};