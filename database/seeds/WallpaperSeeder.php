<?php

use Illuminate\Database\Seeder;

class WallpaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallpapers')->insert([
            [
                'active' => true,
            ]
        ]);

        DB::table('images')->insert([
            [
                'url' => 'display/wallpaper.jpg',
                'display' => 'wall',
                'imageable_id' => 1,
                'imageable_type' => 'App\Wallpaper'
            ]
        ]);
    }
}
