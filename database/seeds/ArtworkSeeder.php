<?php

use App\Artwork;
use App\ArtworkType;
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
      ArtworkType::insert([
          ['name' => 'Textiles', 'slug' => 'textiles'],
          ['name' => 'Mates Burilados', 'slug' => 'chipped_mattes'],
          ['name' => 'Cerámicas', 'slug' => 'ceramics'],
          ['name' => 'Imaginería', 'slug' => 'imagery'],
          ['name' => 'Sombreros', 'slug' => 'hats'],
          ['name' => 'Orfebrería', 'slug' => 'goldsmith'],
      ]);
      factory(Artwork::class, 50)->create();
  }
}
