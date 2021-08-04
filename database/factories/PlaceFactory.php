<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
  return [
    'title' => $faker->word(),
    'description' => $faker->text(),
    'user_id' => 1,
    'type_id' => $faker->numberBetween(1, 3),
    'availability' => 'available',
    'price' => $faker->numberBetween(10000, 90000),
    'city' => $faker->city(),
    'state' => $faker->state(),
    'country' => $faker->country(),
    'address' => $faker->address(),
    'guest_count' => $faker->randomDigitNotZero(),
    'bedroom' => $faker->numberBetween(1, 5),
    'bed' => $faker->numberBetween(1, 5),
    'bath' => $faker->numberBetween(1, 3),
  ];
});
