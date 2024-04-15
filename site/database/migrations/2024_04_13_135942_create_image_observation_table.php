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
        Schema::create('image_observation', function (Blueprint $table) {
           	$table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('observation_id');

            $table->timestamps();

			$table->foreign('image_id')
				->references('id')
				->on('images')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->foreign('observation_id')
				->references('id')
				->on('observations')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->primary(['image_id', 'observation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('image_observation', function(Blueprint $table){
            $table->dropForeign('image_observation_image_id_foreign');
            $table->dropForeign('image_observation_observation_id_foreign');
        });
        Schema::dropIfExists('image_observation');
    }
};
