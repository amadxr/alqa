<?php

use Illuminate\Database\Seeder;

class ImageAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_areas')->insert([
            [
                'coordinates' => json_encode([
                    [123, 80],
                    [200, 120]
                ]),
                'artwork_id' => 1
            ],
            [
                'coordinates' => json_encode([
                    [534, 80],
                    [670, 120]
                ]),
                'artwork_id' => 1
            ]
        ]);
    }
}
