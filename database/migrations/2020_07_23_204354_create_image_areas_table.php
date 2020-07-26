<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_areas', function (Blueprint $table) {
            $table->id();
            $table->json('coordinates');
            $table->unsignedInteger('artwork_id');

            $table->foreign('artwork_id')
                ->references('id')
                ->on('artworks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_areas', function (Blueprint $table) {
            $table->dropForeign(['artwork_id']);
        });
    }
}
