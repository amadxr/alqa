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
            $table->longText('text1');
            $table->longText('highlighted_text');
            $table->longText('text2');
            $table->longText('text3');
            $table->longText('text4');
            $table->unsignedDecimal('width', 6, 2);
            $table->unsignedDecimal('height', 6, 2);
            $table->unsignedDecimal('depth', 6, 2)->nullable();
            $table->string('sku')->unique();
            $table->unsignedInteger('price_in_cents')->nullable();
            $table->boolean('for_sale')->default(false);
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
