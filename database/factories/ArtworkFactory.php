<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artwork;
use Faker\Generator as Faker;

// TODO: add images :)
$factory->define(Artwork::class, function (Faker $faker) {
    return [
        'name' => "{$faker->name}'s Art",
        'sku' => $faker->randomNumber(8),
        'price_in_cents' => $faker->randomNumber(5),
        'origin' => $faker->catchPhrase,
        'description' => $faker->sentence,
        'width' => $faker->randomFloat(2, 0, 100),
        'length' => $faker->randomFloat(2, 0, 100),
    ];
});
