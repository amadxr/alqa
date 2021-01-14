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
          ['name' => 'Textiles'],
          ['name' => 'Mates Burilados'],
          ['name' => 'Cerámicas'],
          ['name' => 'Imaginería'],
          ['name' => 'Sombreros'],
          ['name' => 'Orfebrería'],
      ]);
      factory(Artwork::class, 50)->create();
  }
}
