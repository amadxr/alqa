<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin');
            $table->longText('description');
            $table->unsignedDecimal('width', 6, 2);
            $table->unsignedDecimal('length', 6, 2);
            $table->unsignedDecimal('depth', 6, 2)->nullable();
            $table->string('sku')->unique();
            $table->unsignedDecimal('price', 8, 2);
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
        Schema::dropIfExists('artworks');
    }
}
