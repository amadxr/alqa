<?php

use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artworks')->insert([
            [
                'name' => 'Lliqlla',
                'origin' => 'Ankasmarka',
                'description' => 'Lliqlla de Ankasmarka',
                'width' => 120,
                'length' => 120,
                'sku' => 'LLIQLLA DE ANKASMARKA',
                'price' => 500
            ]
        ]);
    }
}
